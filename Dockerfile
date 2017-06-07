FROM ubuntu:16.04

RUN apt-get update && apt-get install -y \
	curl git zip php php-dom php-curl php-common php-xdebug php-intl\
&& apt-get clean

# * * * * * * * * * install composer
RUN curl --silent --show-error https://getcomposer.org/installer | php && mv /composer.phar /usr/local/bin/composer

# * * * * * * * * * clean up
RUN rm -r /var/lib/apt/lists/*

ADD . /app

WORKDIR /app

RUN composer install

CMD ["vendor/bin/phpunit"]