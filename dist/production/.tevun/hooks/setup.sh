#!/usr/bin/env bash

echo " ~> [hooks\setup.sh] on [${1}, ${2}]"

cd "${1}" || exit

docker exec blueway-nginx bash -c "su -c \"php artisan key:generate\" application"
