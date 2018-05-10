<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Stock;
use App\HistoryStock;
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

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
        $stockHistory = Stock::where('ticker',$ticker)->first()->history()->orderBy('date','desc')->paginate(30);
        // codigo para funcionar a var $loop->iteration mesmo com paginaçao. Copiado da internet
        $skipped = ($stockHistory->currentPage() * $stockHistory->perPage()) - $stockHistory->perPage();
        $period['begin']=0;
        $period['end']=$stockHistory->first()->date;
        //dd($stockHistory);
        // dd($date);
        return view('stock-history')->with(compact('ticker','stockHistory','skipped','period'));
    }

    public function updateHistory(Request $request,$ticker)
    {
        dd($ticker);
        dd($request->all());
        $stock_id = Stock::where('ticker',$ticker)->pluck('id')->get(0);
        $beginDate['day'] = 1;
        $beginDate['month'] = 1;
        $beginDate['year'] = 2018;
        $endDate['day'] = 30;
        $endDate['month'] = 4;
        $endDate['year'] = 2018;
        $pricesHistory = $this->scrapUol($ticker,$beginDate,$endDate);
        
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
    public function scrapUol($ticker,$beginDate,$endDate)
    {
        $client = new Client();
        $url = 'http://cotacoes.economia.uol.com.br/acao/cotacoes-historicas.html?'.
                    'codigo='.$ticker.'.SA'.
                    '&beginDay='.$beginDate['day'].
                    '&beginMonth='.$beginDate['month'].
                    '&beginYear='.$beginDate['year'].
                    '&endDay='.$endDate['day'].
                    '&endMonth='.$endDate['month'].
                    '&endYear='.$endDate['year'].
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
        $parts =  explode(' ',trim($text));
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
