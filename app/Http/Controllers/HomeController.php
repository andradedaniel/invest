<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function scrap()
    {
        $client = new Client();
        $url = 'http://cotacoes.economia.uol.com.br/acao/cotacoes-historicas.html?codigo=PETR4.SA&beginDay=1&beginMonth=1&beginYear=2018&endDay=30&endMonth=1&endYear=2018&size=10000&page=1';
        $crawler = $client->request('GET', $url);
        $cra = $crawler->filter('.tblCotacoes tr')->each(function ($node) {
            $cr  =  $node->text();
            //$title = trim($node->filter('.title a')->text());

            print_r($cr);
        });
        dd($cra);
        return view('scrap')->with('crawler',$crawler);
    }
}
