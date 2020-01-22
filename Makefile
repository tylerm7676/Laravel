build:
	php composer.phar install
	cp .env.local .env
	docker-compose up -d
	docker-compose exec app php artisan key:generate
	docker-compose exec app php artisan config:cache
	docker-compose exec app php artisan migrate

clean:
	docker-compose down

migrate:
	docker-compose exec app php artisan migrate

migration:
	docker-compose exec app php artisan make:migration $(name)

rollback:
	docker-compose exec app php artisan migrate:rollback

run: 
	docker-compose up -d

stop:
	docker-compose stop