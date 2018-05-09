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
    return redirect()->route('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/scrap', 'HomeController@scrap')->name('scrap');
Route::get('/stock', 'StockController@index')->name('stock.index');
Route::get('/stock/{ticker}', 'StockController@show')->name('stock.show');
Route::get('/stock/atualizar-historico/{ticker}', 'StockController@updateHistory')->name('stock.updateHistory');
