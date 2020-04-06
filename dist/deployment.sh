#!/usr/bin/env bash

##
# configure infra
##
function __infra
{
  if [[ -d "${BASE_DIR}/.docker" ]]; then
    rm -rf "${BASE_DIR:?}/.docker"
  fi
  cp -rf "${APP_DIR}/.docker" "${BASE_DIR}"
}

##
# configure laravel backend
##
function __backend
{
  ## declare an array variable
  declare -a BACKEND_FOLDERS=(\
    "app"
    "bootstrap"
    "config"
    "database"
    "helper"
    "public"
    "resources"
    "routes"
    "storage"
  )

  for i in "${BACKEND_FOLDERS[@]}"
  do
    if [[ -d "${BASE_DIR}/${i}" ]]; then
      rm -rf "${BASE_DIR:?}/${i}"
    fi
    cp -r "${APP_DIR}/laravel/${i}" "${BASE_DIR}"
  done

  cp -f "${APP_DIR}/laravel/artisan" "${BASE_DIR}"
  cp -f "${APP_DIR}/laravel/composer.json" "${BASE_DIR}"
  cp -f "${APP_DIR}/laravel/composer.lock" "${BASE_DIR}"
}

##
# configure quasar frontend
##
function __frontend
{
  cd "${APP_DIR}/quasar"
  yarn install
  quasar build -m pwa
  cp -r "${APP_DIR}"/quasar/dist/pwa/* "${BASE_DIR}/public"
}

##
# deploy the app
##
function __deploy
{
  if [[ -f ./.git/ ]];then
   rm -rf ./.git/
  fi
  cd "${BASE_DIR}" || return
  git init
  git remote add deploy "${DEPLOY_REMOTE}"
  git add .
  git rm deploy.sh --cached
  if [[ -f deploy.env.sh ]]; then
    git rm deploy.env.sh --cached
  fi
  git commit -m "Deploy [$(date)]"
  git push deploy master:master --force
}
