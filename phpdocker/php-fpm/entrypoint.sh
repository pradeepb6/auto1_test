#!/bin/bash

set -e

cd /var/www/symfony/backend

composer install

if [ ! -f /var/www/symfony/backend/var/bakery.db ]; then
	php bin/console doctrine:database:create
	php bin/console doctrine:schema:create
fi


php bin/console cache:clear --no-warmup --env=prod

chown -R :www-data var/cache var/log
chmod -R 775 var/cache var/log

chown www-data:www-data var/bakery.db

exec "$@"
