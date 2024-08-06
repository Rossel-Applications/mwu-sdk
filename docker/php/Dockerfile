ARG ALPINE_VERSION=3.20
ARG TARGET_PHP_VERSION=8.2

FROM php:${TARGET_PHP_VERSION}-fpm-alpine${ALPINE_VERSION}

LABEL MAINTAINER="Lasserre François <francois.lasserre@rossel.fr>"

# Environments
ENV TZ=Europe/Paris
ENV WORKDIR=/var/www/app.dev

# Updates and installs system dependencies
RUN apk add --update --no-cache \
  bash \
  tzdata \
  libxml2-dev \
  libpng-dev \
  libjpeg-turbo-dev \
  freetype-dev \
  postgresql-dev \
  libzip-dev \
  libxslt-dev \
  oniguruma-dev \
  linux-headers \
  $PHPIZE_DEPS && \
  rm -rf /var/cache/apk/*

RUN pecl install -f xdebug \
    && docker-php-ext-enable xdebug \
    && ls /etc \
    # ensure that xdebug is not enabled by default
    && rm -f /etc/php8/conf.d/00_xdebug.ini

# Configure php dependency
RUN docker-php-ext-configure soap --enable-soap
RUN docker-php-ext-configure gd --with-freetype --with-jpeg

# Install php dependencies
RUN docker-php-ext-install \
  -j$(nproc) gd \
  #  iconv \
  bcmath \
  xml \
  soap \
  mbstring \
  pdo \
  pdo_mysql \
  pdo_pgsql \
  mysqli \
  zip \
  opcache \
  intl \
  xsl \
  exif \
  soap

# Install pecl
RUN pear config-set http_proxy http://fproxyp.srv.lvdn.net:3128
#RUN pecl install xdebug && docker-php-ext-enable xdebug
#RUN pecl -v install redis && docker-php-ext-enable redis
#RUN pecl -v install rar && docker-php-ext-enable rar

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy php settings
COPY ./docker/php/conf.d ${PHP_INI_DIR}/conf.d

# Workdir
WORKDIR ${WORKDIR}


COPY ./docker/php/crontab  /var/spool/cron/crontabs/root

# Copy files to container
COPY ./ /var/www/app.dev/

# Expose port 9000 and start php-fpm server
EXPOSE 9000

# Run entrypoint
COPY ./docker/php/entrypoint.sh /usr/bin/docker-entrypoint
RUN ["chmod", "+x", "/usr/bin/docker-entrypoint"]

CMD [ "docker-entrypoint" ]
