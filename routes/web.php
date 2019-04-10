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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('user','UserController');

Route::get('/pago', function () {
    return view('/pago/pago');
});

Route::post('/pago', 'SuscripcionController@pago')->name('pago');

Route::resource('cartelera','CarteleraController');
