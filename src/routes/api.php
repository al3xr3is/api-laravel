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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', 'Api\AuthController@register');
Route::post('/login', 'Api\AuthController@login');

Route::namespace('Api')->name('api.')->group(function(){

    Route::prefix('pedidos')->middleware('auth:api')->group(function(){

        Route::get('/', 'PedidoController@index')->name('index_pedidos');
        Route::get('/{id}', 'PedidoController@teste')->name('index_pedidos');
        Route::get('/{id}', 'PedidoController@show')->name('show_pedidos');

        Route::post('/', 'PedidoController@store')->name('store_pedidos');
        Route::put('/{id}', 'PedidoController@update')->name('update_pedidos');
        Route::delete('/{id}', 'PedidoController@delete')->name('delete_pedidos');
    });
});
