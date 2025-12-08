#!/bin/sh

mkdir -p /var/www/symfony/var/cache /var/www/symfony/var/log
chown -R www-data:www-data /var/www/symfony/var

exec "$@"
<?php
