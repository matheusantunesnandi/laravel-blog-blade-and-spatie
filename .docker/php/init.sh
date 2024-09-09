#!/bin/bash

# Verifica se as dependências do Composer estão instaladas
if [ ! -d "/var/www/html/webapp/vendor" ]; then
  echo "Instalando dependências do Composer..."
  composer install --no-dev --no-scripts --prefer-dist --working-dir=/var/www/html/webapp
fi