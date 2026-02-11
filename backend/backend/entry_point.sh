#!/bin/sh
set -e

cd /app

if [ ! -d "node_modules" ]; then
  echo "[dev] node_modules missing -> npm install"
  npm install
else
  echo "[dev] node_modules exists -> skip install"
  npm update
fi

exec npm run dev
