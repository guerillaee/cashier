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

Route::get('/', 'TransactionsController@index')->name('index');
Route::get('/transactions/create', 'TransactionsController@create')->name('transactions.create');
Route::post('/transactions/store', 'TransactionsController@store')->name('transactions.store');
Route::post('/transactions/refund', 'TransactionsController@refund');
