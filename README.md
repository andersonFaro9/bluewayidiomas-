# Blueway System

## Get Started

Create a new copy of docker-compose.yml.develop as docker-compose.yml
Ex.:
```
cp docker-compose.yml.develop docker-compose.yml
```

Create new copy of backend .env
Ex.:
```
cp backend/.env.develop backend/.env
```

Create a new copy of quasar .env
Ex.:
```
cp quasar/.env.develop quasar/.env
```

Start containers
```
docker-compose up -d
```

Install dependencies
```
docker exec -it blueway-nginx bash -c "su -c \"composer install\" application"
```

Generate key
```
docker exec -it blueway-nginx bash -c "su -c \"php artisan key:generate\" application"
```

Migrate the database
```
docker exec -it blueway-nginx bash -c "su -c \"php artisan migrate\" application"
```
