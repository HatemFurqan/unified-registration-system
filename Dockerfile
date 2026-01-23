FROM php:8.0-fpm
# Arguments defined in docker-compose.yml
ARG user
ARG uid
ARG gid
# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip
# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*
# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip
# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
# Add user for laravel application
RUN groupadd -g $gid $user
RUN useradd -u $uid -ms /bin/bash -g $user $user
# Change current user to $user
USER $user
# Copy existing application directory contents
COPY . /var/www
# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
