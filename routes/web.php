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

Route::get('books/{id}', 'Web\client\BookController@show')->name('books.show');

Route::get('/category/{id}', 'Web\CategoryController')->name('category-books.show');

Route::middleware(['auth'])->group(function() {
    
    Route::namespace('Web\Client')->group(function () {

        Route::middleware(['verified'])->group(function() {
            Route::get('/orders/create', 'OrderController@create')->name('orders-client.create');
            Route::post('/orders', 'OrderController@store')->name('orders-client.store');
        });

        Route::prefix('account')->group(function () { 
            Route::get('/', 'UserController@show')->name('user-client.show');
            Route::patch('/', 'UserController@update')->name('user-client.update');

            Route::prefix('addresses')->group(function () { 
                Route::get('/', 'AddressController@index')->name('addresses-client.index');
                
                Route::get('/create', 'AddressController@create')->name('addresses-client.create');
                Route::post('/', 'AddressController@store')->name('addresses-client.store');

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


    Route::middleware(['admin'])->group(function() {
        Route::namespace('Web\Admin')->group(function() {
            Route::prefix('dashboard')->group(function () {
    
                Route::get('/', 'DashboardController')->name('dashboard');
    
                Route::prefix('books')->group(function() {
                    Route::get('/', 'BookController@index')->name('admin-books.index');
    
                    Route::get('/create', 'BookController@create')->name('admin-books.create');
                    
                    Route::post('/', 'BookController@store')->name('admin-books.store');
    
                    Route::get('/{book}', 'BookController@show')->name('admin-books.show');
    
                    Route::get('/{book}/edit', 'BookController@edit')->name('admin-books.edit');
                    Route::put('/{book}', 'BookController@update')->name('admin-books.update');
    
                    Route::delete('/{book}', 'BookController@destroy')->name('admin-books.destroy');
    
                });
    
                Route::prefix('users')->group(function() {
                    Route::get('/', 'UserController@index')->name('admin-users.index');
    
                    Route::get('/create', 'UserController@create')->name('admin-users.create');
                    
                    Route::post('/', 'UserController@store')->name('admin-users.store');
    
                    Route::get('/{user}', 'UserController@show')->name('admin-users.show');
    
                    Route::get('/{user}/edit', 'UserController@edit')->name('admin-users.edit');
                    Route::put('/{user}', 'UserController@update')->name('admin-users.update');
    
                    Route::delete('/{user}', 'UserController@destroy')->name('admin-users.destroy');
    
                });
    
                Route::prefix('authors')->group(function() {
                    Route::get('/', 'AuthorController@index')->name('admin-authors.index');
    
                    Route::get('/create', 'AuthorController@create')->name('admin-authors.create');
                    
                    Route::post('/', 'AuthorController@store')->name('admin-authors.store');
    
                    Route::get('/{author}', 'AuthorController@show')->name('admin-authors.show');
    
                    Route::get('/{author}/edit', 'AuthorController@edit')->name('admin-authors.edit');
                    Route::put('/{author}', 'AuthorController@update')->name('admin-authors.update');
    
                    Route::delete('/{author}', 'AuthorController@destroy')->name('admin-authors.destroy');
                });
    
                Route::prefix('categories')->group(function() {
                    Route::get('/', 'CategoryController@index')->name('admin-categories.index');
    
                    Route::get('/create', 'CategoryController@create')->name('admin-categories.create');
                    
                    Route::post('/', 'CategoryController@store')->name('admin-categories.store');
    
                    Route::get('/{category}', 'CategoryController@show')->name('admin-categories.show');
    
                    Route::get('/{category}/edit', 'CategoryController@edit')->name('admin-categories.edit');
                    Route::put('/{category}', 'CategoryController@update')->name('admin-categories.update');
    
                    Route::delete('/{category}', 'CategoryController@destroy')->name('admin-categories.destroy');
                });
    
                Route::prefix('orders')->group(function() {
                    Route::get('/', 'OrderController@index')->name('admin-orders.index');
    
                    Route::get('/create', 'OrderController@create')->name('admin-orders.create');
                    
                    Route::post('/', 'OrderController@store')->name('admin-orders.store');
    
                    Route::get('/{order}', 'OrderController@show')->name('admin-orders.show');
    
                    Route::get('/{order}/edit', 'OrderController@edit')->name('admin-orders.edit');
                    Route::put('/{order}', 'OrderController@update')->name('admin-orders.update');
    
                    Route::delete('/{order}', 'OrderController@destroy')->name('admin-orders.destroy');
                });
    
            });
        });
    });
});