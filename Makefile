init: docker-down-clear api-clear docker-pull docker-build docker-up api-init
up: docker-up
build: docker-build
down: docker-down
fixtures: api-fixtures

docker-up:
	docker-compose up -d

docker-build:
	docker-compose build

docker-down:
	docker-compose down --remove-orphans

docker-down-clear:
	docker-compose down -v --remove-orphans

docker-pull:
	docker-compose pull

api-clear:
	docker run --rm -v ${PWD}/api:/app -w /app alpine sh -c 'rm -rf var/*'

api-init: api-permissions api-composer-install api-wait-db api-migrations

api-test:
	docker-compose run --rm api-php-cli ./vendor/bin/phpunit

api-permissions:
	docker run --rm -v ${PWD}/api:/app -w /app alpine chmod 777 var

api-migrations:
	docker-compose run --rm api-php-cli composer app do:mi:mi --no-interaction

api-fixtures:
	docker-compose run --rm api-php-cli composer app doctrine:fixtures:load

api-composer-install:
	docker-compose run --rm api-php-cli composer install

api-wait-db:
	docker-compose run --rm api-php-cli wait-for-it database:5432 -t 30