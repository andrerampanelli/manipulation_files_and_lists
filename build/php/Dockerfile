FROM php:8.0-fpm-alpine AS builder

# lumen packages
RUN docker-php-ext-install tokenizer mysqli pdo_mysql

RUN apk --no-cache add shadow && usermod -u 1000 www-data
