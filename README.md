# Parking-lot-alegra

Small testing project for alegra.com

## Getting Started

Most necessary modules are already on the repository, additional steps will be specified below.

### Prerequisites

* MySQL/MariaDB up and running (XAMPP is recommended)
* Laravel
* Node.js
* NPM



### Installing

On the main folder run. (if MySQL/MariaDB daemon is not running a listening on port specified on app.js file it will not run successfully)

```
php artisan serve
```

Be also sure to press 

```
Inicializar
```

Check node and npm version to be sure node is installed with

```
node -v
npm -v
```

## Routes

### Ingresos

* Route::get('/ingreso', 'IngresoController@index');
* Route::post('/ingreso', 'IngresoController@store');
* Route::put('/ingreso/{id}', 'IngresoController@update');
* Route::post('/ingreso/{id}', 'IngresoController@destroy');

### Celdas

* Route::get('/celda', 'CeldaController@index');
* Route::post('/celda', 'CeldaController@store');
* Route::put('/celda/{id}', 'CeldaController@update');

## Built With

* [Laravel](https://laravel.com/) - Framework used for server side programming
* [PHP](http://www.php.net/) - Language used for server side programming
* [MariaDB](https://mariadb.org/) - Database used
* [Vue.js](https://vuejs.org/) - Front-end Framework used



## Authors

* **Jose Villarroel** - *Initial work* - [Wayhem](https://github.com/Wayhem)

## License

This project is licensed under the MIT License - see the [LICENSE.txt](LICENSE.txt) file for details
