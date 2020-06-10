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

Route::get('/', 'ViewsController@home');
Route::get('/create-employee', 'ViewsController@createEmployee');

Route::get('/edit-employee/{id}', 'ViewsController@editEmployee');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
