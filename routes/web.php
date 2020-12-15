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


Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index')->name('home');

Route::get('books/{id}', 'Web\client\BookController@show')->name('books-client.show');

Route::middleware(['auth'])->group(function() {
    
    Route::namespace('Web\client')->group(function () {

        Route::middleware(['verified'])->group(function() {
            Route::get('/orders/create', 'OrderController@create')->name('orders-client.create');
            Route::post('/orders', 'OrderController@store')->name('orders-client.store');
        });

        Route::prefix('account')->group(function () { 
            Route::get('/', 'UserController@show')->name('user-client.show');
            Route::patch('/', 'UserController@update')->name('user-client.update');

            Route::prefix('addresses')->group(function () { 
                Route::get('/', 'AddressController@index')->name('addresses-client.index');
                Route::get('/create', 'AddressController@show')->name('addresses-client.create');

                Route::get('/{address}/edit', 'AddressController@edit')->name('addresses-client.edit');
    
                Route::put('/{address}', 'AddressController@update')->name('addresses-client.update');
                Route::delete('/{address}', 'AddressController@destroy')->name('addresses-client.delete');
            });    

            Route::prefix('orders')->group(function () {                
                Route::get('/', 'OrderController@index')->name('orders-client.index');
                Route::get('/{order}', 'OrderController@show')->name('orders-client.show');
            });
        });
    });

});