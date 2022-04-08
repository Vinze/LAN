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

Route::middleware('guest')->group(function() {
    Route::controller('AuthController')->group(function() {
        Route::get('login', 'getLogin')->name('login');
        Route::get('oauth/{service}', 'getOauth');
        Route::get('oauth/{service}/callback', 'getOauthCallback');
    });
});

Route::middleware('auth')->group(function() {
    Route::controller('DashboardController')->group(function() {
        Route::get('/', 'getIndex');
    });

    Route::controller('DocumentController')->group(function() {
        Route::get('documents/view/{document}', 'getView');
        Route::get('documents/new/{document?}', 'getForm');
        Route::post('documents/new/{document?}', 'postForm');
        Route::get('documents/edit/{document}', 'getForm');
        Route::post('documents/edit/{document}', 'postForm');
    });

    Route::controller('AuthController')->group(function() {
        Route::get('logout', 'getLogout')->name('logout');
    });
});
