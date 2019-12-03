#!/bin/bash

FLAG=$1
DOCKER="-dk"

if [ FLAG == DOCKER ]; then
    python3 test_create_accounts.py -dk
else
    python3 test_create_accounts.py
fi

php artisan tinker < tinkerino.php

mysql < test_auth.sql

if [ FLAG == DOCKER ]; then
    python3 test_admin.py -dk
else
    python3 test_admin.py
fi