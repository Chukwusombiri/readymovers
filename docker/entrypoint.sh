#!/bin/sh
php artisan migrate --seed --force
exec supervisord -c /etc/supervisor/conf.d/supervisord.conf