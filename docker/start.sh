#!/bin/bash
set -e

sed -i "s/Listen 80/Listen ${PORT:-80}/" /etc/apache2/ports.conf
sed -i "s/<VirtualHost \*:80>/<VirtualHost *:${PORT:-80}>/" /etc/apache2/sites-available/000-default.conf

php artisan config:clear
php artisan route:clear
php artisan view:clear

php artisan storage:link || true

echo "=== Running migrations ==="
php artisan migrate --force -vvv
echo "=== Migrations finished ==="

apache2-foreground