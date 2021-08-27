######################################!!! THE NEW ONE !!!#################################################
FROM php:7.4.2-apache

RUN pecl install xdebug && docker-php-ext-enable xdebug && docker-php-ext-install mysqli pdo pdo_mysql \
# ALL CONFIG BELOW WILL BE SAVED ON .INI SPECIFIC FILE \n\
# THIS CONFIG ARE OK AT 20/08/2021 AND IS BASIC FOR VSCODE PHP DEV \n\
# IMPORTANT!! JUST WORK CORECTELY WEN I USE THE DOCKER VM IP ADDRESS \n\
&& echo "\n\
xdebug.client_host = 172.17.0.1 \n\
xdebug.mode = "develop,debug,trace" \n\
xdebug.start_with_request = "yes" \n\
xdebug.start_upon_error = "yes" \n\
xdebug.client_port = 9003 \n\
xdebug.show_error_trace = 1 \n\
xdebug.show_exception_trace = 1 \n\
xdebug.show_local_vars = 1 \n\
" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

EXPOSE 9003