FROM php:8.1.6-apache
RUN a2enmod rewrite && \
    docker-php-ext-install pdo_mysql && \
    docker-php-ext-enable pdo_mysql && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    apt-get update && \
    apt-get install -y --no-install-recommends p7zip-full && \
    apt-get install -y zip && \
    apt-get install -y git && \
    cd /var/www/html && \
    git clone -b master https://github.com/Ikon-design/cube5.git && \
    cp -r cube5/www/vide-grenier-en-ligne-master/. . && \
    rm /etc/apache2/sites-enabled/000-default.conf && \
    cp /var/www/html/cube5/000-default.conf /etc/apache2/sites-enabled/000-default.conf && \
    php /usr/local/bin/composer install
