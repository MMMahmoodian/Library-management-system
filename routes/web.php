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
    return view('index');
});

Route::get('/register', 'UserController@registrationForm')->name("register");
Route::post('/register', 'UserController@register');
Route::get('/login', 'UserController@loginForm')->name("login");
Route::post('/login', 'UserController@login');
Route::post('/logout', 'UserController@logout')->name("logout");

Route::get('/home', 'HomeController@index')->name('home');
