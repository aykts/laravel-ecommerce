<?php

use Illuminate\Support\Facades\Route;

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

// Auth Routes
Route::prefix('auth')->group(function () {

    Route::post('login', 'auth\LoginController@index')
        ->name('login');

    Route::post('register', 'auth\RegisterController@index')
        ->name('register');

    Route::post('refresh', 'auth\AuthController@refreshToken')
        ->name('refresh');

});


// Catalog Routes
Route::prefix('catalogs')->group(function () {

    Route::get('/', 'catalog\CatalogController@index')->name('catalog.index');

    Route::get('{id}', 'catalog\CatalogController@show')->name('catalog.find')
        ->where(array('id' => '[0-9]+'));

    Route::post('/', 'catalog\CatalogController@store')->name('catalog.store');
});

Route::middleware('auth:api')->group(function () {

    Route::prefix('auth')->group(function () {
        Route::get('me', 'auth\AuthController@me')
            ->name('auth.me');

        Route::post('logout', 'auth\AuthController@logout')
            ->name('auth.logout');

    });

});

