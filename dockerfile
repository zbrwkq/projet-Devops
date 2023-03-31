# Première étape : Builder le projet
FROM composer:2.2.4 as build

WORKDIR /app

COPY . .

RUN composer install --no-dev --prefer-dist --no-scripts --no-progress --no-suggest

# Deuxième étape : Créer l'image finale
FROM php:8.1-fpm-alpine

WORKDIR /var/www/html

RUN apk add --no-cache \
        $PHPIZE_DEPS \
        curl \
        git \
        libzip-dev \
        zip \
    && docker-php-ext-install \
        pdo_mysql \
        zip \
    && pecl install \
        apcu \
    && docker-php-ext-enable \
        apcu

COPY --from=build /app .

ENV PHP_MEMORY_LIMIT 2G
ENV PHP_POST_MAX_SIZE 100M
ENV PHP_UPLOAD_MAX_FILESIZE 100M

EXPOSE 9000

CMD ["php-fpm"]
