<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/* Ruta para listar los usuarios registrados */
Route::get('/getUsers', 'HomeController@getUsers');
Route::get('/saveChanges', 'HomeController@saveChanges');
Route::get('/delItem', 'HomeController@delItem');
Route::post('/sendMail', 'HomeController@sendMail');
Route::get('/getMails', 'HomeController@getMails');
