#!/bin/bash

service mysqld start

cd /opt/ci-test
composer install
mysql -u root < ./.docker/setup.sql
mysql -u root -e "select Host, User, Password from mysql.user;"
vendor/bin/codecept run