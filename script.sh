mkdir cube-dev
cd cube-dev
git clone -b dev https://github.com/Ikon-design/cube5.git
cd cube5
docker compose up -d
docker exec web php /usr/local/bin/composer require --dev phpunit/phpunit
docker exec web php /usr/local/bin/composer install
docker cp ./000-default.conf web:/etc/apache2/sites-available/
docker restart web