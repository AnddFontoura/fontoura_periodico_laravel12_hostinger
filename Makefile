down:
	docker compose down -v --remove-orphans

up:
	docker compose up -d

restart:
	docker compose down -v --remove-orphans
	docker compose up -d

set-database:
	docker exec -it fontoura_periodicos_hostinger php artisan migrate
	docker exec -it fontoura_periodicos_hostinger php artisan db:seed

reset-database:
	docker exec -it fontoura_periodicos_hostinger php artisan migrate:fresh

build-js:
	npm run build
