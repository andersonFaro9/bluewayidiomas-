#!/usr/bin/env bash

BASE_DIR=$(dirname $(readlink -f "${0}"))
APP_DIR=$(dirname $(dirname "${BASE_DIR}"))
export BUILD_ENV="${1}"
export DEPLOY_REMOTE="${2}"

if [[ -f "${BASE_DIR}/deploy.env.sh" ]]; then
  source "${BASE_DIR}/deploy.env.sh"
fi

source "${APP_DIR}/dist/deployment.sh"

__infra

__backend

__frontend

__deploy
