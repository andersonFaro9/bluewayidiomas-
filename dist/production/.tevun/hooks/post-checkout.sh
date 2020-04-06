#!/usr/bin/env bash

echo " ~> [hooks\post-checkout.sh] on [${1}, ${2}]"

cd "${1}" || exit

docker-compose stop blueway-queue && docker-compose rm blueway-queue -f && docker-compose up -d blueway-queue
