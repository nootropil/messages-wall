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

Route::get('/', 'Message\MessageController@index');
Route::post('/registration', 'Auth\RegisterController@register');
Route::get('/registration', 'Auth\RegisterController@showRegistrationForm');
Route::get('/registration-success', 'Auth\RegisterController@registrationSuccess');
Route::get('/login', 'Auth\LoginController@showLoginForm');
Route::post('/login', 'Auth\LoginController@login');