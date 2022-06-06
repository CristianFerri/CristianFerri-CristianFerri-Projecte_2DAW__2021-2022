#!/bin/bash

code .
konsole -e "npm run watch"
konsole -e "php artisan serve"
