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

Auth::routes();
Route::get('user/activation/{token}', 'Auth\RegisterController@activateUser')
    ->name('user.activate');

Route::group([
    'middleware' => 'auth',
    'prefix' => 'dashboard'
], function () {
    Route::get('/', 'DashboardController@index');
    Route::get('/{page}', 'NotFoundController@index');
});
