#!/bin/bash
set -e

# Executa o script de inicialização
/usr/local/bin/init.sh

# Inicia o Apache em primeiro plano
exec apache2-foreground
