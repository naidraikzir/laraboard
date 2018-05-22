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
    'prefix' => 'dashboard',
    'namespace' => 'Dashboard'
], function () {
    Route::get('/', 'IndexController@index');
    Route::get('images/{name}', 'ImageController@getImage');

    Route::group([
        'prefix' => 'data',
        'middleware' => 'should_ajax'
    ], function () {
        Route::get('users', 'UserController@index');
        Route::post('images', 'ImageController@saveImage');
    });

    // Forwarded to vue-router
    Route::get('/{page?}', 'IndexController@index')->where('page', '(.*)');
});
