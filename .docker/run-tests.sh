#!/bin/bash

cd /opt/ci-test
composer install
vendor/bin/codecept run