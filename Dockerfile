FROM php:8.2-fpm

# Sistem paketləri
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Work directory
WORKDIR /var/www

# Proyekt faylları
COPY . .

# Composer install
RUN composer install --no-dev --optimize-autoloader

# Permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage

# Cache optimize (optional)
RUN php artisan config:cache || true
RUN php artisan route:cache || true

EXPOSE 9000

CMD ["php-fpm"]