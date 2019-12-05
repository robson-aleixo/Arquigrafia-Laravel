#!/bin/bash

FLAG=$1
DOCKER="-dk"

if [ FLAG == DOCKER ]; then
    python3 test_admin.py -dk
    python3 test_tags.py -dk
    python3 test_tombos.py -dk
else
    python3 test_admin.py
    python3 test_tags.py
    python3 test_tombos.py
fi