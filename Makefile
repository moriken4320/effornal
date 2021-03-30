.PHONY: init
init:
	cp laravel/.env.example .env
	cp laravel/.env.example laravel/.env
	docker-compose up -d --build
	docker-compose exec app composer install
	docker-compose exec app npm ci
	docker-compose exec app php artisan key:generate
	@make migrate
	@make seed

.PHONY: build
build:
	docker-compose build --no-cache --force-rm

.PHONY: up
up:
	docker-compose up -d

.PHONY: stop
stop:
	docker-compose stop

.PHONY: down
down:
	docker-compose down
	@make vorm

.PHONY: ps
ps:
	docker ps

.PHONY: nginx
nginx:
	docker-compose exec nginx bash

.PHONY: app
app:
	docker-compose exec app bash

.PHONY: clear
clear:
	docker-compose exec app php artisan config:clear

.PHONY: migrate
migrate:
	docker-compose exec app php artisan migrate

.PHONY: rollback
rollback:
	docker-compose exec app php artisan migrate:rollback

.PHONY: fresh
fresh:
	docker-compose exec app php artisan migrate:fresh

.PHONY: seed
seed:
	docker-compose exec app php artisan db:seed

.PHONY: tinker
tinker:
	docker-compose exec app php artisan tinker

.PHONY: volume-remove
vorm:
	docker volume rm effornal_docker-volume


