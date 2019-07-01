FROM php:7-fpm

RUN apt-get update && apt-get install -y curl git

RUN apt-get update && apt-get install -y zlib1g-dev libzip-dev \
  && docker-php-ext-install -j$(nproc) zip

RUN docker-php-ext-install mysqli

RUN curl -sS https://getcomposer.org/installer | php \
        && mv composer.phar /usr/local/bin/ \
        && ln -s /usr/local/bin/composer.phar /usr/local/bin/composer

COPY composer.* /app/
WORKDIR /app

ENV PATH="~/.composer/vendor/bin:./vendor/bin:${PATH}"
