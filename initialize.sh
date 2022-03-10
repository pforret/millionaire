#!/usr/bin/env bash

php artisan migrate:fresh --seed
php artisan million:rates --all
php artisan million:rates
php artisan cache:clear
php artisan million:images
