#!/bin/sh

composer install
php bin/hyperf.php migrate
php bin/hyperf.php server:watch