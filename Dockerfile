# Default Dockerfile
#
# @link     https://www.hyperf.io
# @document https://doc.hyperf.io
# @contact  group@hyperf.io
# @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE

FROM hyperf/hyperf:7.2-alpine-v3.9-cli
LABEL maintainer="Hyperf Developers <group@hyperf.io>" version="1.0" license="MIT" app.name="Hyperf"

##
# ---------- env settings ----------
##
# --build-arg timezone=Asia/Shanghai
ARG timezone

ENV TIMEZONE=${timezone:-"Asia/Shanghai"} \
    APP_ENV=prod \
    JIEBA_VERSION="0.0.3" \
    SCAN_CACHEABLE=(true)

# update
RUN set -ex \
    && apk update \
    # install composer
    && cd /tmp \
    && wget https://mirrors.aliyun.com/composer/composer.phar \
    && chmod u+x composer.phar \
    && mv composer.phar /usr/local/bin/composer \
    && composer config -g repo.packagist composer https://mirrors.aliyun.com/composer \
    # show php version and extensions
    && php -v \
    && php -m \
    && php --ri swoole \
    #  ---------- some config ----------
    && cd /etc/php7 \
    # - config PHP
    && { \
        echo "upload_max_filesize=100M"; \
        echo "post_max_size=108M"; \
        echo "memory_limit=1024M"; \
        echo "date.timezone=${TIMEZONE}"; \
    } | tee conf.d/99_overrides.ini \
    # - config timezone
    && ln -sf /usr/share/zoneinfo/${TIMEZONE} /etc/localtime \
    && echo "${TIMEZONE}" > /etc/timezone \
    # ---------- clear works ----------
    && rm -rf /var/cache/apk/* /tmp/* /usr/share/man

# PHPX Jieba
RUN set -ex \
    && apk update \
    && apk add --no-cache gcc cmake g++ make php7-dev \
    # - phpx
    && cd /root \
    && git clone https://github.com/swoole/phpx.git \
    && cd phpx \
    && ./build.sh \
    && mv bin/phpx /usr/local/bin/ \
    && cmake . \
    && make -j 4 \
    && make install \
    # - jieba
    && cd /tmp \
    && curl -SL "https://github.com/limingxinleo/phpx-jieba-ext/archive/v${JIEBA_VERSION}.tar.gz" -o jieba.tar.gz \
    && mkdir -p jieba \
    && tar -xf jieba.tar.gz -C jieba --strip-components=1 \
    && ( \
        cd jieba \
        && cp -r dict /dict \
        && phpx build \
        && cp -r jieba/lib/jieba.so /usr/lib/php7/modules/jieba.so \
        && cp -r 51_jieba.ini /etc/php7/conf.d \
    ) \
    # ---------- clear works ----------
    && rm -rf /var/cache/apk/* /tmp/* /usr/share/man \
    && echo -e "\033[42;37m Build Completed :).\033[0m\n"

WORKDIR /opt/www

# Composer Cache
# COPY ./composer.* /opt/www/
# RUN composer install --no-dev --no-scripts

COPY . /opt/www
RUN composer install --no-dev -o && php bin/hyperf.php

EXPOSE 9501

ENTRYPOINT ["php", "/opt/www/bin/hyperf.php", "start"]
