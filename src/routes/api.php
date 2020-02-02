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


Route::namespace('Api')->name('api.')->group(function(){

    Route::prefix('usuarios')->group(function(){

        Route::get('/', 'UserController@index')->name('index_users');
        Route::get('/{id}', 'UserController@show')->name('show_users');

        Route::post('/', 'UserController@store')->name('store_users');
        Route::put('/{id}', 'UserController@update')->name('update_users');
        Route::delete('/{id}', 'UserController@delete')->name('delete_users');
    });

    Route::prefix('pecas')->group(function(){

Route::get('/', 'PecaController@index')->name('index_pecas');
Route::get('/{id}', 'PecaController@show')->name('show_pecas');

Route::post('/', 'PecaController@store')->name('store_pecas');
Route::put('/{id}', 'PecaController@update')->name('update_pecas');
Route::delete('/{id}', 'PecaController@delete')->name('delete_pecas');
});

    Route::prefix('pedidos')->group(function(){

        Route::get('/', 'PedidoController@index')->name('index_pedidos');
        Route::get('/{id}', 'PedidoController@show')->name('show_pedidos');

        Route::post('/', 'PedidoController@store')->name('store_pedidos');
        Route::put('/{id}', 'PedidoController@update')->name('update_pedidos');
        Route::delete('/{id}', 'PedidoController@delete')->name('delete_pedidos');
    });
});
