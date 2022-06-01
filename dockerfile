FROM php:8.1.6-apache
RUN a2enmod rewrite
RUN docker-php-ext-install pdo_mysql \
    && docker-php-ext-enable pdo_mysql
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN apt-get update && \
    apt-get install -y --no-install-recommends p7zip-full && \
    apt-get install -y zip && \
    php /usr/local/bin/composer install
