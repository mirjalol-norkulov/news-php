FROM php:7.2-apache

COPY ./docker/php/vhost.conf /etc/apache2/sites-available/000-default.conf
COPY . /var/www/php
RUN chmod 775 -R /var/www/php
RUN docker-php-ext-install mysqli pdo pdo_mysql