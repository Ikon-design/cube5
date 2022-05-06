git clone git@github.com:Ikon-design/cube5.git
cd cube5
cp -r cube5/. .
rm -rf cube5
docker compose up -d
#docker exec database bash -c 'mysql -uroot -p"root"' videgrenier < www/vide-grenier-en-ligne-master/sql/import.sql
docker exec -i database mysql --user test --password=test videgrenier < www/vide-grenier-en-ligne-master/sql/import.sql