#!/bin/bash

FLAG=$1
DOCKER="-dk"

if [ FLAG == DOCKER ]; then
    python3 test_admin.py -dk
else
    python3 test_admin.py
fi