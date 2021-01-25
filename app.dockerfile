FROM php:7.1.5-alpine

MAINTAINER herloct <rafiqul@gmail.com>

COPY ./vendor/bin/phpcs /usr/local/bin/phpcs
RUN  chmod +x /usr/local/bin/phpcs \
    && rm -rf /var/cache/apk/* /var/tmp/* /tmp/*

VOLUME ["/project"]
WORKDIR /project

ENTRYPOINT ["phpcs"]
CMD ["--version"]