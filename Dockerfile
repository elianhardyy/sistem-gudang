FROM php:8.1-fpm

WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    libzip-dev \
    unzip \
    git \
    curl \
    mysql-client

RUN docker-php-ext-install pdo pdo_mysql zip

COPY . /var/www

RUN composer install

EXPOSE 9000
CMD ["php-fpm"]