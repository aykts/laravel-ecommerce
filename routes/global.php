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

Route::prefix('auth')->group(function () {

    Route::get('login', function(){
       return "aa";
       die();
    });

    Route::post('login', 'auth\LoginController@index')
        ->name('login');

    Route::post('register', 'auth\RegisterController@index')
        ->name('register');

    Route::group(['middleware' => 'api'], static function () {
        Route::post('me', 'auth\AuthController@me')
            ->name('me');

        Route::post('logout', 'auth\AuthController@logout')
            ->name('logout');

        Route::post('refresh', 'auth\AuthController@refreshToken')
            ->name('refresh');
    });

});
