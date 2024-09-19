#!/bin/bash

# composer install -o --working-dir="$WORKDIR"/application
composer install

mkdir -p /var/log/cron
touch /var/log/cron/cron.log
chmod 777 /var/log/cron/cron.log
chmod -R 0644 /var/spool/cron/crontabs
#crond /var/spool/cron/crontabs -f -L /var/log/cron/cron.log "$@"
#php-fpm

echo "otot"
# turn on bash's job control
set -m
# Start the "main" PHP process and put it in the background
php-fpm &
# Start the helper crond process
crond
# now we bring the primary process back into the foreground
fg %1
