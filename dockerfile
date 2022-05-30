FROM php:7.4-apache
RUN a2enmod rewrite
RUN docker-php-ext-install mysqli
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN apt-get update && \
    apt-get install -y --no-install-recommends p7zip-full && \
    apt-get install -y zip