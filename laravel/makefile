
init:
	docker-compose down
	docker volume rm api_futura-mysql_data
	docker-compose up -d
	docker exec -it futura-api bash -c "su -c \"composer install\" application"
	docker exec -it futura-api bash -c "su -c \"php artisan key:generate\" application"
	docker-compose down

dev:
	docker-compose up -d

down:
	docker-compose down

migrate:
	docker exec -it futura-api bash -c "su -c \"php artisan migrate\" application"

seed:
	docker exec -it futura-api bash -c "su -c \"php artisan db:seed\" application"

update:
	docker exec -it futura-api bash -c "su -c \"composer update --lock\" application"

backup:
	docker exec -it futura-backup backup

list:
	docker exec -it futura-backup list

# make restore BECAPE=2019_07_05_03_36_42
restore:
	docker exec -it futura-backup restore ${BECAPE}

# make restore BECAPE=2019_07_05_03_36_42
upload:
	docker exec -it futura-backup upload ${BECAPE}
