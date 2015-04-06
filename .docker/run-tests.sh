#!/bin/bash

cd /opt/ci-test
composer install
php artisan migrate
php artisan db:seed
vendor/bin/codecept run