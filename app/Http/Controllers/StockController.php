<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Stock;
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;
use App\HistoryStock;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Stock::all();
        $stocksCount = Stock::count();
        return view('stock')->with(compact('stocks','stocksCount'));
    }

    public function show($ticker)
    {
        echo 'estou na pagina de show ==>'.$ticker;
    }

    public function updateHistory(Request $request,$ticker)
    {
        //dd($id);
        //dd($request->all());
        $stock_id = Stock::where('ticker',$ticker)->pluck('id')->get(0);
        $begin_date['day'] = 1;
        $begin_date['month'] = 1;
        $begin_date['year'] = 2018;
        $end_date['day'] = 30;
        $end_date['month'] = 4;
        $end_date['year'] = 2018;
        $pricesHistory = $this->scrapUol($ticker,$begin_date,$end_date);
        
        foreach ($pricesHistory as $priceHistory){
            //implementar try catch
            HistoryStock::firstOrCreate(['stock_id'=>$stock_id,
                                  'date'=>$priceHistory['date'],
                                  'closed'=>$priceHistory['closed'],
                                  'min'=>$priceHistory['min'],
                                  'max'=>$priceHistory['max'],
                                  'var'=>$priceHistory['var'],
                                  'var_percent'=>$priceHistory['varPercent'],
                                ]);
        }
        return redirect()->route('stock.show',['ticker'=>$ticker]);

    }

    // Faz scrap no site da UOL
    // TODO: implementar try catch
    public function scrapUol($ticker,$begin_date,$end_date)
    {
        $client = new Client();
        $url = 'http://cotacoes.economia.uol.com.br/acao/cotacoes-historicas.html?'.
                    'codigo='.$ticker.'.SA'.
                    '&beginDay='.$begin_date['day'].
                    '&beginMonth='.$begin_date['month'].
                    '&beginYear='.$begin_date['year'].
                    '&endDay='.$end_date['day'].
                    '&endMonth='.$end_date['month'].
                    '&endYear='.$end_date['year'].
                    '&size=10000&page=1';
        $html = $client->request('GET', $url);
        $htmlTable = $html->filter("table[class='tblCotacoes'] tbody")->html();
        $htmlTable = preg_replace('/(\v|\s)+/', ' ', $htmlTable);
        $crawler = new Crawler($htmlTable);
        
        $pricesHistory = $crawler->filter("tr")->each(function ($node){
            return $this->extractPriceHistory($node->text());
            //var_dump($priceHistory);
        });
        //var_dump($priceHistory);
        //return view('scrap')->with('pricesHistory',$pricesHistory);
        return $pricesHistory; 
    }

    public function extractPriceHistory($text)
    {
        $priceHistory = [];
        $parts =  explode(' ',$text);
            $priceHistory['date'] = Carbon::createFromFormat('d/m/Y',$parts[0])->toDateString();
            $priceHistory['closed'] = str_replace(',','.',$parts[1]);
            $priceHistory['min'] = str_replace(',','.',$parts[2]);
            $priceHistory['max'] = str_replace(',','.',$parts[3]);
            $priceHistory['var'] = str_replace(',','.',$parts[4]);
            $priceHistory['varPercent'] = str_replace(',','.',$parts[5]);
            //$priceHistory['volume'] = $parts[6];
        return $priceHistory;
    }

}
