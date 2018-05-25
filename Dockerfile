#
#--------------------------------------------------------------------------
# Image Setup
#--------------------------------------------------------------------------
#

FROM alpine:latest

LABEL maintainer="g9308370@hotmail.com"

COPY . /var/www

USER root
RUN chmod -R 777 /var/www/storage
RUN chmod -R 777 /var/www/bootstrap/cache

#
#--------------------------------------------------------------------------
# Final Touch
#--------------------------------------------------------------------------
#

WORKDIR /var/www
VOLUME /var/www
