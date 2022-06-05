# Если надо подключить shell переменные, то создаём тут же .env.docker файл и делаем.
#include .env.docker
#export

# Поддержка возможности запускать шелл-скрипты
SHELL:=/bin/bash

# Кэш
c: cache-clear cache-warmup
cc: cache-clear
cw: cache-warmup
cache-clear:
	docker-compose run --rm php-cli bin/console c:c
cache-warmup:
	docker-compose run --rm php-cli bin/console c:w

up: docker-up
down: docker-down
restart: docker-down docker-up
init: docker-down init-common
reset: docker-down-clear init-common
init-common: clear docker-pull docker-build docker-up backend-init
test: test
test-coverage: test-coverage
test-unit: test-unit
test-unit-coverage: test-unit-coverage

chown:
	sudo chown -R vitiok78:vitiok78 ./

docker-up:
	docker-compose up -d

docker-down:
	docker-compose down --remove-orphans

docker-down-clear:
	docker-compose down -v --remove-orphans

docker-pull:
	docker-compose pull

docker-build:
	docker-compose build

backend-init: composer-install ready

clear:
	docker run --rm -v ${PWD}/backend:/app --workdir=/app alpine rm -f .ready

composer-install:
	docker-compose run --rm php-cli composer -V
	docker-compose run --rm php-cli composer install

ready:
	docker run --rm -v ${PWD}/backend:/app --workdir=/app alpine touch .ready

test:
	docker-compose run --rm php-cli php bin/phpunit

test-coverage:
	docker-compose run --rm php-cli php bin/phpunit --coverage-clover var/clover.xml --coverage-html var/coverage

test-unit:
	docker-compose run --rm php-cli php bin/phpunit --testsuite=unit

test-unit-coverage:
	docker-compose run --rm php-cli php bin/phpunit --testsuite=unit --coverage-clover var/clover.xml --coverage-html var/coverage
