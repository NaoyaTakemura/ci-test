#!/bin/bash

service mysqld start

cd /opt/ci-test
composer install
mysql -u root -e "CREATE DATABASE task_manager CHARACTER SET utf8;"
#php artisan migrate
#php artisan db:seed
vendor/bin/codecept run