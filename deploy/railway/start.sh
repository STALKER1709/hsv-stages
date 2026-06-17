#!/bin/sh
set -e

PORT=${PORT:-80}
sed -i "s/listen 80;/listen ${PORT};/" /etc/nginx/nginx.conf

mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache storage/app/public bootstrap/cache
chmod -R 775 storage bootstrap/cache

php artisan storage:link || true
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan migrate --force

exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
