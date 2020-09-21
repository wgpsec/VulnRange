FROM php:7.4-apache

COPY src/index.php /var/www/html/index.php

RUN sed -i 's/deb.debian.org/mirrors.aliyun.com/g' /etc/apt/sources.list \
    && sed -i 's/security.debian.org/mirrors.aliyun.com/g' /etc/apt/sources.list \
    && apt update \
    && apt install libffi-dev

RUN set -x \
  && docker-php-ext-install ffi \
  && docker-php-ext-enable ffi \
  && chown -R www-data:www-data /var/www/html

COPY src/php.ini /usr/local/etc/php/php.ini

RUN set -x \
  && a2enmod rewrite cgi \
  && a2ensite 000-default

COPY src/start.sh /start.sh
RUN set -x \
  && chmod +x /start.sh

EXPOSE 80
ENTRYPOINT [ "/start.sh" ]