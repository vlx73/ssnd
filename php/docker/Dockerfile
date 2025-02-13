ARG PHP_VERSION=8.3

FROM php:${PHP_VERSION}-apache-bookworm as base

LABEL maintainer="Image maintainer <mainter@contactemail.com>" \
      vendor="Institution or person name" \
      description="PHP image for backend development with xdebug and composer" \
      version="1.0"

## Update package information
RUN apt-get update \
 && apt-get install -y --no-install-recommends \
 git \
 zlib1g-dev \
 libpq-dev \
 libicu-dev \
 libzip-dev \
 libxml2-dev  \
 libcurl3-dev \
 libonig-dev \
 libmagickwand-dev \
    g++

###
## PHP Extensisons
###

## Install zip libraries and extension
RUN docker-php-ext-install zip fileinfo mbstring curl exif xml filter
## Install intl library and extension
RUN docker-php-ext-configure intl \
    && docker-php-ext-install intl
## PostgreSQL PDO support
RUN docker-php-ext-install pdo pdo_pgsql pgsql

#install iamgick
#RUN pecl install imagick \
#    && docker-php-ext-enable imagick

RUN apt-get install --yes libapache2-mod-xsendfile

## Configure Apache
RUN a2enmod rewrite

## Install Composer
RUN curl -sS https://getcomposer.org/installer \
  | php -- --install-dir=/usr/local/bin --filename=composer

## Install and enable xdebug
RUN pecl install xdebug \
&& docker-php-ext-enable xdebug

## Configure Apache
RUN a2enmod rewrite \
    && sed -i 's!/var/www/html!/var/www/public!g' /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www
# run as non root user

## copy .ini files for php
COPY ./docker-php-ext-xdebug.ini /usr/local/etc/php/conf.d/
COPY ./docker-custom-php.ini "$PHP_INI_DIR/php.ini"

# run as non root user
#USER www-data
