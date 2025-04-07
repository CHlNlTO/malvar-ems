#!/bin/bash
echo "Preparing server for deployment..."
sudo chown -R ckdigitals:www-data /var/www/html/malvar-ems
sudo chmod -R 775 /var/www/html/malvar-ems/storage
sudo chmod -R 775 /var/www/html/malvar-ems/bootstrap/cache
echo "Server ready for deployment!"
