# Utilisez une image PHP 8.0 basée sur Alpine Linux
FROM php:8.0-fpm-alpine

# Copiez les fichiers de votre projet dans le conteneur Docker
COPY . /var/www/html

# Définissez le répertoire de travail
WORKDIR /var/www/html

# Installez les dépendances PHP nécessaires
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

# Définissez les variables d'environnement pour PHP
ENV PHP_MEMORY_LIMIT 2G
ENV PHP_POST_MAX_SIZE 100M
ENV PHP_UPLOAD_MAX_FILESIZE 100M

# Exposez le port 9000 pour PHP-FPM
EXPOSE 9000

# Démarrez le serveur PHP-FPM
CMD ["php-fpm"]
