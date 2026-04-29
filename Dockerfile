FROM php:8.2-fpm

# System paketləri
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Project copy
COPY . .

# Permissions
RUN chown -R www-data:www-data /var/www

# Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

CMD ["php-fpm"]