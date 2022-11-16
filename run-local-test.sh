#!/usr/bin/env bash

# WARNING!
# You need setup `.env.testing` for test database connection: DB_DATABASE=foundarium_test

if [ ! -e .env.testing ]
then
    echo "You need setup '.env.testing' for test database connection: DB_DATABASE=foundarium_test"
fi

docker-compose -f docker-compose-testing.yml --env-file=.env.testing up -d \
&& docker-compose -f docker-compose-testing.yml exec app php artisan --env=testing migrate \
&& docker-compose -f docker-compose-testing.yml exec app php ./vendor/bin/phpunit \
&& docker-compose -f docker-compose-testing.yml down



