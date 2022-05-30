git clone git@github.com:Ikon-design/cube5.git
cp -r cube5/. .
rm -rf cube5
docker compose up -d
docker exec cube5-www-1 php /usr/local/bin/composer install
docker exec cube5-www-1 rm /etc/apache2/sites-available/000-default.conf
docker exec cube5-www-1 scp ./000-default.conf /etc/apache2/sites-available
docker cp 000-default.conf cube5-www-1:/etc/apache2/sites-available
docker restart cube5-www-1