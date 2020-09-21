FROM php:5.6.11-apache
COPY src/index.php /var/www/html/index.php
COPY src/php.ini /usr/local/etc/php/php.ini
COPY src/start.sh /start.sh

RUN set -x \
  && chmod +x /start.sh \
  && chown -R www-data:www-data /var/www/html

EXPOSE 80
ENTRYPOINT [ "/start.sh" ]