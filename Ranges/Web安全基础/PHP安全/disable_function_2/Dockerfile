FROM antswordproject/antsword-labs:bypass_disable_functions_1
COPY src/index.php /var/www/html/index.php
COPY src/php.ini /usr/local/etc/php/php.ini
COPY src/start.sh /start.sh

RUN set -x \
  && chmod +x /start.sh \
  && chown -R www-data:www-data /var/www/html

EXPOSE 80
ENTRYPOINT [ "/start.sh" ]

RUN set -x \
  && a2enmod rewrite cgi \
  && a2ensite 000-default
