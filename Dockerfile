FROM php:8.2-apache

# 1. Install system packages (Added gnupg and curl for Node.js)
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    git \
    curl \
    gnupg \
    && docker-php-ext-install pdo_mysql zip \
    && a2enmod rewrite

# --- NEW: Install Node.js (Version 20) ---
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && \
    apt-get install -y nodejs

# 2. Apache Config
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 3. Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 4. Copy app files
WORKDIR /var/www/html
COPY . .

# 5. Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# --- NEW: Install JS dependencies and Build Assets ---
RUN npm install
RUN npm run build

# 6. Fix permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 7. Expose Port 80
EXPOSE 80