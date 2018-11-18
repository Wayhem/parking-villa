<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('content/content');
});

Route::get('/ingreso', 'IngresoController@index');
Route::post('/ingreso', 'IngresoController@store');
Route::put('/ingreso/{id}', 'IngresoController@update');
Route::post('/ingreso/{id}', 'IngresoController@destroy');

Route::get('/celda', 'CeldaController@index');
Route::post('/celda', 'CeldaController@store');
Route::put('/celda/{id}', 'CeldaController@update');
