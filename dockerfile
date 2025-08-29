FROM wordpress:latest

RUN apt-get update && apt-get install -y \
    git unzip libzip-dev \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && rm -rf /var/lib/apt/lists/*

COPY ./xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
