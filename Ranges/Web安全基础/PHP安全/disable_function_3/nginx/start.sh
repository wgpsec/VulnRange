#!/bin/bash

rm -f /usr/share/nginx/html/index.html
touch /usr/share/nginx/html/index.php

nginx -g "daemon off;"
