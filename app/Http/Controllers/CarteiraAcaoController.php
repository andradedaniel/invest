<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CarteiraAcao;
use App\Stock;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Request;

class CarteiraAcaoController extends Controller
{
    public function index()
    {
        $operacoes_acoes = CarteiraAcao::where('user_id',\Auth::user()->id)
                                        ->get();
        // dd($operacoes_acoes);
        return view('carteira-acao');
    }

    public function comprar()
    {
        return view('carteira-acao-comprar');
    }

    public function carteira()
    {
        $operacoes = DB::table('operacoes_acao_fii')->get();
        // dd($operacoes);
        // $stocks = Stock::paginate(10);
        // $stocksCount = Stock::count();
        return view('carteira')->with(compact('operacoes'));
    }

    public function novaOperacao()
    {
         $stocks = Stock::all(['ticker'])->toArray();
         
        //  dd($stocks);
        // $stocksCount = Stock::count();
        return view('carteira-nova-operacao')->with(compact('stocks'));
    }

    public function novaOperacaoSave(Request $request)
    {
         dd($request);
    }
}
