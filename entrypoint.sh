#!/bin/bash

# This would be cool if it worked, but it doesn't :-(
# I stole it from SO.
# timeout 10 bash -c 'until printf "" 2>>/dev/null >>/dev/tcp/$0$1; do sleep; done' $DB_HOST $DB_PORT

# TODO: Do this better.
php artisan migrate --force

exec docker-php-entrypoint "$@"
