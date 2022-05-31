git clone git@github.com:Ikon-design/cube5.git
cp -r cube5/. .
rm -rf cube5
docker compose up -d
docker exec web php /usr/local/bin/composer require --dev phpunit/phpunit
docker exec web php /usr/local/bin/composer install
docker exec web rm /etc/apache2/sites-available/000-default.conf
docker cp ./000-default.conf web:/etc/apache2/sites-available/
docker restart web