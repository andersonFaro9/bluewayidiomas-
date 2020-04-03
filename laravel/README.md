## Blueway

### Start environment
```
$ cp .env.develop .env
$ cp docker-compose.yml.develop docker-compose.yml
$ docker-compose up -d
```

### Prepare app
```
$ composer install
$ artisan key:generate
```

### Configure database
```
$ artisan migrate
```

### Open in browser
```
$ xdg-open http://localhost:8010 </dev/null &>/dev/null &
```
