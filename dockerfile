FROM wordpress:latest

# Instala Xdebug
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# Copia config customizada
COPY ./xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
