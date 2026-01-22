#!/bin/sh
set -e

echo "Waiting for database connection..."
until php -r "try { \$pdo = new PDO('mysql:host=${DB_HOST:-mysql_db};port=${DB_PORT:-3306}', '${DB_USERNAME}', '${DB_PASSWORD}'); \$pdo = null; exit(0); } catch (PDOException \$e) { exit(1); }" > /dev/null 2>&1; do
    echo "Database is unavailable - sleeping"
    sleep 2
done

echo "Database is up - executing commands"

# Generate application key if not set
if [ -z "$APP_KEY" ] || [ "$APP_KEY" = "" ]; then
    echo "Generating application key..."
    php artisan key:generate --force || true
fi

# Cache configuration (only in production)
if [ "$APP_ENV" = "prod" ] || [ "$APP_ENV" = "production" ]; then
    php artisan config:cache || true
    php artisan route:cache || true
    php artisan view:cache || true
fi

echo "Application is ready!"

exec "$@"
