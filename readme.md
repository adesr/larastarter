<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

## About LaraStarter
LaraStarter built to cut initial creation time of a laravel project. LaraStarter attempts to take the pain out of creating laravel project by adding a few of existing library, such as:

- [AdminLTE](https://adminlte.io).
- [Zizaco Entrust](https://github.com/zizaco/entrust).
- [Yajra Datatables](https://github.com/yajra/laravel-datatables).
- [Maatwebsite Excel](https://github.com/maatwebsite/Laravel-Excel).
- [Codedge FPDF](https://github.com/codedge/laravel-fpdf).

## Setup
Place this project to anywhere in your environment, and then do following steps inside your project directory:

install dependencies
```
$ composer update
```

update .env file
```
APP_ENV=local
APP_KEY=base64:GwSQO63EgfObeRF+Ma5Uq9pRkYcAoZILi0HXor2p3Rc=
APP_DEBUG=true
APP_LOG_LEVEL=debug
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=larastarter
DB_USERNAME=user
DB_PASSWORD=pass
```

generate laravel's app key
```
php artisan key:generate
```

execute laravel's migration
```
php artisan migrate
```

execute laravel's seed
```
php artisan db:seed
```

run laravel application
```
php artisan serve
```
