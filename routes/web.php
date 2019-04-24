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
    return view('/auth/login');
});

Route::get('/pago', function () {
    return view('/pago/pago');
});
Route::post('/pago', 'SuscripcionController@pago')->name('pago');

Auth::routes();
Route::resource('user','UserController');

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('cartelera','CarteleraController');
Route::resource('pelicula','PeliculaController');
Route::resource('reserva','ReservaController');

Route::resource('proyeccion','ProyeccionController');

Route::get('/listar', 'ProyeccionController@listar')->name('listar');

