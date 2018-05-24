<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stock;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Stock::paginate(10);
        $stocksCount = Stock::count();
        return view('stock')->with(compact('stocks','stocksCount'));
    }

    public function show($ticker)
    {
        //
    }
    
}
