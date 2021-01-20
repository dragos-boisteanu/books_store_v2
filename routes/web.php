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

Route::get('/', 'Web\Client\BookController@index')->name('home');

Route::get('/search', 'Web\Client\SearchController@index')->name('search');

Route::get('books/{id}', 'Web\Client\BookController@show')->name('books.show');

Route::get('/categories/{id}', 'Web\Client\CategoryController')->name('category-books.show');
Route::get('/authors/{id}', 'Web\Client\AuthorController')->name('author-books.show');
Route::get('/publishers/{id}', 'Web\Client\PublisherController')->name('publisher-books.show');

Route::middleware(['auth'])->group(function() {
    
    Route::namespace('Web\Client')->group(function () {

        Route::middleware(['verified'])->group(function() {
            Route::get('/orders/create', 'OrderController@create')->name('client-orders.create');
            Route::post('/orders', 'OrderController@store')->name('client-orders.store');
        });

        Route::prefix('account')->group(function () { 
            Route::get('/', 'UserController@show')->name('client-user.show');
            Route::patch('/', 'UserController@update')->name('client-user.update');

            Route::prefix('addresses')->group(function () { 
                Route::get('/', 'AddressController@index')->name('client-addresses.index');
                
                Route::get('/create', 'AddressController@create')->name('client-addresses.create');
                Route::post('/', 'AddressController@store')->name('client-addresses.store');

                Route::get('/{address}/edit', 'AddressController@edit')->name('client-addresses.edit');
                Route::put('/{address}', 'AddressController@update')->name('client-addresses.update');

                Route::delete('/{address}/delete', 'AddressController@destroy')->name('client-addresses.delete');
            });    

            Route::prefix('orders')->group(function () {                
                Route::get('/', 'OrderController@index')->name('client-orders.index');
                Route::get('/{order}', 'OrderController@show')->name('client-orders.show');
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

                Route::prefix('tags')->group(function() {
                    Route::get('/', 'TagController@index')->name('admin-tags.index');
    
                    Route::get('/create', 'TagController@create')->name('admin-tags.create');
                    
                    Route::post('/', 'TagController@store')->name('admin-tags.store');
    
                    Route::get('/{tag}', 'TagController@show')->name('admin-tags.show');
    
                    Route::get('/{tag}/edit', 'TagController@edit')->name('admin-tags.edit');

                    Route::put('/{tag}', 'TagController@update')->name('admin-tags.update');
    
                    Route::delete('/{tag}', 'TagController@destroy')->name('admin-tags.destroy');
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