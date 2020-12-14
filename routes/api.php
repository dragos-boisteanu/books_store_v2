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

Route::namespace('Api\Client')->group(function () {
    Route::prefix('carts')->group(function() {

        Route::get('/', 'CartController@show')->name('carts.show');
        Route::patch('/', 'CartController@update')->name('carts.patch');
      
        Route::delete('/', 'CartController@empty')->name('carts.empty');
    
        Route::post('/{id}', 'CartController@addItem')->name('carts.add-item');
        Route::delete('/{id}', 'CartController@removeItem')->name('carts.remove-item');
    });        
});

Route::middleware(['auth'])->group(function() {

    Route::namespace('Api\Client')->group(function () {

        Route::get('cities/{county}', 'CityController@index')->name('cities-list');

      
    });
});