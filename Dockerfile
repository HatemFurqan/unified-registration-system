# Multi-stage build for Laravel application
# Stage 1: Build frontend assets
FROM node:16-alpine AS frontend-builder

WORKDIR /app

# Copy package files
COPY package*.json ./

# Install dependencies (including dev dependencies for building)
RUN npm ci

# Copy frontend source files
COPY webpack.mix.js ./
COPY resources ./resources

# Build assets
RUN npm run production

# Stage 2: PHP application
FROM php:8.0-fpm-alpine

# Build arguments
ARG user=www-data
ARG uid=1000
ARG gid=1000

# Install system dependencies and PHP extensions
RUN apk add --no-cache \
    git \
    curl \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    oniguruma-dev \
    mysql-client \
    shadow \
    && docker-php-ext-install \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip \
    opcache

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user
RUN groupadd -g ${gid} ${user} || true \
    && useradd -u ${uid} -g ${gid} -m -s /bin/sh ${user} || true

# Set working directory
WORKDIR /var/www

# Copy composer files
COPY composer.json composer.lock ./

# Install PHP dependencies (no dev dependencies for production)
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# Copy application files
COPY . .

# Copy built assets from frontend stage
COPY --from=frontend-builder /app/public/js ./public/js
COPY --from=frontend-builder /app/public/css ./public/css
COPY --from=frontend-builder /app/public/mix-manifest.json ./public/mix-manifest.json

# Set permissions
RUN chown -R ${user}:${user} /var/www \
    && chmod -R 755 /var/www \
    && chmod -R 775 /var/www/storage \
    && chmod -R 775 /var/www/bootstrap/cache

# Copy PHP-FPM configuration
COPY docker/php-fpm.conf /usr/local/etc/php-fpm.d/www.conf

# Copy PHP configuration
COPY docker/php.ini /usr/local/etc/php/conf.d/custom.ini

# Copy entrypoint script
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Switch to user
USER ${user}

# Expose port 9000 for PHP-FPM
EXPOSE 9000

# Set entrypoint
ENTRYPOINT ["docker-entrypoint.sh"]

# Start PHP-FPM
CMD ["php-fpm", "-F"]
