FROM php:7.2-apache

COPY ./docker/php/vhost.conf /etc/apache2/sites-available/000-default.conf
COPY . /var/www/php
RUN chmod 775 -R /var/www/php
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable mod_rewrite
# apache2 enable mode
RUN a2enmod rewrite

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install git
RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y git