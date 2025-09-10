FROM php:8.2-fpm-alpine

WORKDIR /var/www/html

# Copy app files
COPY ../ /var/www/html

# Install PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

EXPOSE 9000

# PHP-FPM runs by default
