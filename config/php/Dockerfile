FROM php:8-fpm-alpine

RUN apk add --update --no-cache --virtual .build-deps \
  linux-headers g++ make autoconf yaml-dev

RUN apk update --no-cache && apk add \
  libmcrypt-dev \
  oniguruma-dev \
  libxml2-dev \
  icu-dev \
  tzdata

RUN pecl install redis \
  pecl install xdebug \
  pecl install mcrypt

RUN docker-php-ext-install intl
RUN docker-php-ext-install pcntl
RUN docker-php-ext-install mysqli
RUN docker-php-ext-install sockets
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install calendar
RUN docker-php-ext-install pdo_mysql

RUN docker-php-ext-enable redis.so xdebug.so mcrypt.so

RUN rm -rf /var/cache/apk/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

COPY php.ini /usr/local/etc/php/php.ini

CMD ["php-fpm"]
