#!/bin/sh
php artisan migrate --force
exec supervisord -c /etc/supervisor/conf.d/supervisord.conf