FROM wyveo/nginx-php-fpm:php74

COPY docker-entrypoint.sh .

ENTRYPOINT ["/var/www/docker-entrypoint.sh"]
