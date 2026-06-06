install:
	composer install

migrate:
	php artisan migrate

serve:
	php artisan serve

docker-build:
	docker build -t shorts-url .

docker-run:
	docker run -p 8080:8080 --env-file .env shorts-url
