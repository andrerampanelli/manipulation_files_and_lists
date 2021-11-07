FROM php:8.0-fpm-alpine

COPY --chown=www-data:www-data ./lumen /var/www/html

# lumen packages
RUN docker-php-ext-install tokenizer mysqli pdo_mysql