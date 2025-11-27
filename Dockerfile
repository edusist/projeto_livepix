FROM php:8.3-apache

# instalar extensões necessárias
RUN apt-get update && apt-get install -y \
    zip unzip libonig-dev libxml2-dev

# Instalar extensão PDO MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Habilitar mod_rewrite
RUN a2enmod rewrite

WORKDIR /var/www/html

# Permitir .htaccess
RUN sed -ri 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf
