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
Route::get('/acoes', 'CarteiraAcaoController@index')->name('carteira-acao.index');
Route::get('/acoes/comprar', 'CarteiraAcaoController@comprar')->name('carteira-acao.comprar');
Route::get('/carteira', 'CarteiraAcaoController@carteira')->name('carteira-acao.carteira');


Route::prefix('admin/acoes')->group(function () { 
    Route::get('/', 'StockController@index')->name('stock.index');
    // Route::get('/historico-cotacoes', 'StockHistoryController@index')->name('stock-history.index');
    Route::get('/historico-cotacoes/{ticker}', 'StockHistoryController@show')->name('stock-history.show');
    // Route::get('/atualizar-historico/{ticker}', 'StockController@updateHistory')->name('stock.updateHistory');
    Route::post('/atualizar-historico/{ticker}', 'StockHistoryController@atualizar')->name('stock-history.update');
    Route::post('/atualizar-historico-em-massa/', 'StockHistoryController@atualizarEmMassa')->name('stock-history.updateEmMassa');

    Route::get('/teste', 'StockHistoryController@teste')->name('stock-history.teste');

    Route::get('/historico-cotacao/{acao}','GraficoController@historicoCotacao')->name('grafico.historico-cotacao');
});

