# Use PHP 8.2 with Apache
FROM php:8.2-apache

# 1. Install development packages and clean up apt cache
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip \
    && a2enmod rewrite

# 2. Apache Configuration: Point public folder to /public (Laravel standard)
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 3. Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 4. Copy application files
COPY . /var/www/html

# 5. Set working directory
WORKDIR /var/www/html

# 6. Run Composer to install dependencies
RUN composer install --no-dev --optimize-autoloader

# 7. Set permissions (Critical for Laravel)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 8. Start Apache
CMD ["apache2-foreground"]