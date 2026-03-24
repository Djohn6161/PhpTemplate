FROM php:8.1.34-apache

# Enable mod_rewrite for .htaccess
RUN a2enmod rewrite

# Enable mod_headers (often needed for headers)
RUN a2enmod headers

# Install PHP extensions for MySQL
RUN docker-php-ext-install pdo pdo_mysql mysqli

WORKDIR /var/www/html
