# Use Apache HTTP Server Project as a parent image
FROM php:7.0-apache

#COPY config/php.ini /user/local/etc/php/
COPY ./* /var/www/html/
COPY ./register.php /var/www/html/register.php

# Set the working directory to /var/www/html
WORKDIR /var/www/html/


# Make port 80 available to the world outside this container
EXPOSE 80


