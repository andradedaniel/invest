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
    return redirect()->route('dashboard');
});

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Route::prefix('admin/acoes')->group(function () { 
    Route::get('/', 'StockController@index')->name('stock.index');
    Route::get('/historico-cotacoes', 'StockController@index')->name('stock.index');
    Route::get('/historico-cotacoes/{ticker}', 'StockController@show')->name('stock.show');
    Route::get('/atualizar-historico/{ticker}', 'StockController@updateHistory')->name('stock.updateHistory');
    Route::post('/atualizar-historico/{ticker}', 'StockController@updateHistory')->name('stock.updateHistory');
});