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