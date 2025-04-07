#!/bin/bash
echo "Restoring upload permissions..."
sudo chown -R www-data:www-data /var/www/html/malvar-ems
sudo chmod -R 775 /var/www/html/malvar-ems/storage
sudo chmod -R 775 /var/www/html/malvar-ems/bootstrap/cache

# Ensure directories exist
sudo mkdir -p /var/www/html/malvar-ems/storage/app/public
sudo mkdir -p /var/www/html/malvar-ems/storage/app/livewire-tmp

# Set specific upload permissions
sudo chown -R ckdigitals:www-data /var/www/html/malvar-ems/storage/app/livewire-tmp
sudo chown -R ckdigitals:www-data /var/www/html/malvar-ems/storage/app/public
echo "Upload permissions restored!"
