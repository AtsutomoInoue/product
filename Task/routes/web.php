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

Route::get('/', 'TasksController@index');
Route::get('/{id}', 'TasksController@show')->where('id','[0-9]+');
Route::get('/create', 'TasksController@create');
Route::post('/create', 'TasksController@store');
Route::get('/edit/{id}', 'TasksController@edit')->where('id', '[0-9]');
Route::put('/edit/{id}', 'TasksController@update')->where('id', '[0-9]');
Route::delete('/{id}', 'TasksController@delete')->where('id', '[0-9]');
Route::get('/test', 'TasksTestController@index');
