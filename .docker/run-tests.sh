#!/bin/bash

service mysqld start

cd /opt/ci-test
composer install
mysql -u root < ./.docker/setup.sql
vendor/bin/codecept run