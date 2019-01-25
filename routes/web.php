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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::resource('product', 'ProductController');
Route::resource('order', 'OrderController');

Route::get('/cart', 'CartController@index');
Route::get('/cart/add/{id}', 'CartController@addToCart');
Route::post('/cart/update/{id}', 'CartController@updateCart');
Route::get('/cart/delete/{id}', 'CartController@removeFromCart');

Route::get('/home', 'HomeController@index')->name('home');