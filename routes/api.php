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
    Route::middleware(['auth:api'])->group(function () {
        Route::prefix('book')->group(function () {
            Route::get('/list', 'BooksController@list');
            Route::post('/add', 'BooksController@create');
            Route::post('/{id}/edit', 'BooksController@edit');
        });
        Route::prefix('category')->group(function () {
            Route::get('/list', 'CategoryController@list');
            Route::post('/add', 'CategoryController@create');
            Route::post('/{id}/edit', 'CategoryController@edit');
        });

    });
});
