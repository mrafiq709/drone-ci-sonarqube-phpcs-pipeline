FROM php:7.1.5-alpine

MAINTAINER herloct <rafiqul@gmail.com>

ENV PHPCS_VERSION=3.3.2

RUN curl -L https://github.com/scuti-asia/PHP_CodeSniffer/releases/download/$PHPCS_VERSION/phpcs.phar > /usr/local/bin/phpcs \
    && chmod +x /usr/local/bin/phpcs \
    && rm -rf /var/cache/apk/* /var/tmp/* /tmp/*

VOLUME ["/project"]
WORKDIR /project

ENTRYPOINT ["phpcs"]
CMD ["--version"]