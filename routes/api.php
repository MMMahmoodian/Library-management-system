<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('user')->group(function () {
    Route::post('/login', 'UsersController@login');
    Route::post('/register', 'UsersController@register');
});

Route::prefix('management')->group(function () {
//    Route::middleware(['api-auth'])->group(function () {
        Route::prefix('book')->group(function () {
            Route::get('/list', 'Management\BookController@list');
            Route::post('/add', 'Management\BookController@create');
            Route::post('/edit', 'Management\BookController@edit');
        });
        Route::prefix('category')->group(function () {
            Route::get('/list', 'Management\CategoryController@list');
            Route::post('/add', 'Management\CategoryController@create');
            Route::post('/{id}/edit', 'Management\CategoryController@edit');
        });

//    });
});
