FROM php:8.3-apache

# Instala dependências do sistema e bibliotecas PHP
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libzip-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Instala extensões PHP
RUN docker-php-ext-install pdo_mysql mbstring exif bcmath gd zip

# Install Xdebug
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# Habilita o mod_rewrite do Apache
RUN a2enmod rewrite && a2enmod ssl && a2enmod socache_shmcb

# Instala o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Cria certificados SSL autoassinados se não existirem
RUN mkdir -p /etc/ssl/private /etc/ssl/certs && \
    if [ ! -f /etc/ssl/certs/localhost.crt ]; then \
        openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout /etc/ssl/private/localhost.key -out /etc/ssl/certs/localhost.crt -subj "/C=BR/ST=SC/L=TB/O=GEX/CN=localhost"; \
    fi

# Copia a configuração do vhost para a imagem
COPY ./vhost.conf /etc/apache2/sites-available/vhost.conf

# Remove vhosts padrão e adiciona o vhost customizado
RUN a2dissite 000-default.conf default-ssl.conf \ 
    && a2ensite vhost.conf

# Copia o script de inicialização para a imagem
COPY init.sh /usr/local/bin/init.sh
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/init.sh /usr/local/bin/entrypoint.sh

# Copia a configuração customizada do PHP para a imagem
COPY custom-php.ini /usr/local/etc/php/conf.d/custom-php.ini

WORKDIR /var/www/html/webapp

# Inicia o Apache em primeiro plano
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]