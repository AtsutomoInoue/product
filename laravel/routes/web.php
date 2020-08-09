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

Route::get('changepassword', 'HomeController@showChangePasswordForm');
Route::post('changepassword', 'HomeController@changePassword')->name('changepassword');

Route::resource('/cyclings', 'CyclingController');
Route::resource('/plamodels', 'PlamodelController');

Route::get('/login/github', 'Auth\LoginController@redirectToProvider');
Route::get('/login/github/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/sample','SampleController@index');
