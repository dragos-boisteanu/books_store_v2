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

    Route::get('/search', 'SearchController@index')->name('search');
    Route::get('/categories', 'CategoryController@index')->name('categories');

    Route::prefix('carts')->group(function() {

        Route::get('/', 'CartController@show')->name('carts.show');
        Route::patch('/', 'CartController@update')->name('carts.patch');
      
        Route::delete('/', 'CartController@empty')->name('carts.empty');
    
        Route::get('/{id}', 'CartController@getItem')->name('carts.get-item');
        Route::post('/{id}', 'CartController@addItem')->name('carts.add-item');
        
        Route::delete('/{id}', 'CartController@removeItem')->name('carts.remove-item');

    });        
});

Route::middleware(['auth'])->group(function() {

    Route::namespace('Api\Client')->group(function () {

        Route::get('cities/{county}', 'CityController@index')->name('cities-list');

    });

    Route::middleware(['admin'])->group(function() {
        Route::namespace('Api\Admin')->group(function() {

            Route::prefix('authors')->group(function () {
                Route::get('/find', 'AuthorController@find')->name('authors.find');
                Route::get('/check', 'AuthorController@check')->name('authors.check');
            });

            Route::prefix('tags')->group(function () {
                Route::post('/', 'TagController@store')->name('tags.store');
                Route::get('/find', 'TagController@find')->name('tags.find');
                Route::get('/check', 'TagController@check')->name('tags.check');
            });
            
        });
    });
});