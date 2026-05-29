# syntax=docker/dockerfile:1

FROM php:8.4-fpm-bookworm AS app

WORKDIR /var/www/html

COPY src/ /var/www/html/
COPY dist-prod/config.php /var/www/html/config.php

RUN php -m | grep -q '^SimpleXML$' \
    && find /var/www/html -type d -exec chmod 755 {} + \
    && find /var/www/html -type f -exec chmod 644 {} + \
    && chown -R www-data:www-data /var/www/html

FROM caddy:2 AS web

COPY --from=app /var/www/html /var/www/html
