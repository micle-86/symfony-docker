FROM php:7.4-fpm

RUN apt-get update && apt-get install -y \
    libpq-dev \
    wget \
    zlib1g-dev \
    libmcrypt-dev \
    libzip-dev \
    openssl

RUN pecl install xdebug && docker-php-ext-enable xdebug

ADD ./php.ini /usr/local/etc/php/php.ini
ADD ./xdebug.log /var/log/xdebug.log

RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /symfony