<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CarteiraAcao;

class CarteiraAcaoController extends Controller
{
    public function index()
    {
        $operacoes_acoes = CarteiraAcao::where('user_id',\Auth::user()->id)
                                        ->get();
        dd($operacoes_acoes);
        return view('carteira-acao');
    }

    public function comprar()
    {
        return view('carteira-acao-comprar');
    }
}
