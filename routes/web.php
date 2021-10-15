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

/* Route::get('/', function () {
    return view('welcome');
});  */


//Product crud route
Route::get('/','ProductController@index')->name('home');
Route::get('/product/add','ProductController@add')->name('add');
Route::post('/product/store','ProductController@store')->name('store');
Route::get('/product/edit/{id}','ProductController@editView')->name('products.edit');
Route::post('/product/update/{id}','ProductController@update')->name('products.update');
Route::delete('/product/destory','ProductController@destroy')->name('products.destory');

Route::post('product-sortable','ProductController@sortable');

