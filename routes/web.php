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


Route::get('/', 'HomeController@index');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/accounts', 'AccountController@index');
Route::get('/accounts/create', 'AccountController@create');
Route::post('/accounts/store', 'AccountController@store');
Route::get('/accounts/edit/{id}','AccountController@edit')->where('id', '[0-9]+');
Route::post('/accounts/update', 'AccountController@update');

Route::get('/transactions', 'TransactionController@index');
Route::get('/transactions/create', 'TransactionController@create');
Route::post('/transactions/store', 'TransactionController@store');
Route::get('/transactions/edit/{id}','TransactionController@edit')->where('id', '[0-9]+');
Route::post('/transactions/update', 'TransactionController@update');

Route::get('/transactions/extract', 'TransactionController@formextract');
Route::post('/transactions/getextract', 'TransactionController@getextract');
Route::get('/transactions/showextract', 'TransactionController@showextract');
Route::get('/transactions/showextract/{filter}','TransactionController@showextract')->where('filter', '[0-9]+');