FROM yiisoft/yii2-php:latest

RUN apt-get update && apt-get install -y \
    curl \
    php-curl

COPY . /app

WORKDIR /app

RUN composer install