FROM php:alpine
WORKDIR /app

## Extras
RUN apk add build-base autoconf git libxml2-dev icu-dev
RUN apk add zsh
RUN sh -c "$(curl -fsSL https://raw.githubusercontent.com/robbyrussell/oh-my-zsh/master/tools/install.sh)"

## PHP
RUN apk --no-cache add pcre-dev ${PHPIZE_DEPS}
RUN pecl install xdebug
RUN apk del pcre-dev ${PHPIZE_DEPS}
RUN docker-php-ext-install sysvsem bcmath pcntl intl
RUN docker-php-ext-enable xdebug pcntl intl
RUN apk add bash
RUN apk add composer
RUN wget https://get.symfony.com/cli/installer -O - | bash
RUN mv /root/.symfony/bin/symfony /usr/local/bin/symfony
# Node
RUN apk add nodejs yarn

COPY bin /app/bin
COPY config /app/config
COPY public /app/public
COPY src /app/src
COPY tests /app/tests
COPY composer.json /app/composer.json
COPY composer.lock /app/composer.lock
COPY symfony.lock /app/symfony.lock
COPY phpunit.xml.dist /app/phpunit.xml.dist
COPY infection.json.dist /app/infection.json.dist
COPY phpcs.xml.dist /app/phpcs.xml.dist
COPY .env /app/.env
COPY .env.test /app/.env.test
COPY src-js/src /app/src-js/src
COPY src-js/package.json /app/src-js/package.json
COPY src-js/tsconfig.json /app/src-js/tsconfig.json
COPY src-js/webpack.config.js /app/src-js/webpack.config.js
COPY src-js/yarn.lock /app/src-js/yarn.lock

RUN cd /app/src-js && yarn install && yarn webpack && cd -
RUN composer install
RUN symfony self:update -y

CMD symfony server:start
