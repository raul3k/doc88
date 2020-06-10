<?php

use Illuminate\Http\Request;
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

/** Client Routes */
Route::resource('client', 'ClientsController');
Route::put('/client/{client}/restore', 'ClientsController@restore')->name('client.restore');

/** Pastel Routes */
Route::resource('pastel', 'PastelsController');
Route::get('/pastel/{pastel}/photo', 'PastelsController@photo')->name('pastel.photo');
Route::put('/pastel/{pastel}/updatePhoto', 'PastelsController@updatePhoto')->name('pastel.update_photo');
Route::put('/pastel/{pastel}/restore', 'PastelsController@restore')->name('pastel.restore');

/** Order Routes */
Route::resource('order', 'OrdersController');
Route::put('/order/{order}/restore', 'OrdersController@restore')->name('order.restore');
Route::get('/order/client/{client}', 'OrdersController@getOrdersByClient')->name('order.by_client');
Route::post('/order/{client}/finish', 'OrdersController@finishOrder')->name('order.finish');

