FROM php:apache

RUN apt-get update && apt-get install --no-install-recommends -y zip unzip git
RUN pear install --alldeps Mail Net_SMTP Mail_Mime

RUN docker-php-ext-install pdo pdo_mysql

RUN a2enmod rewrite

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
