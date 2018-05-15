<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HistoryStock;
use App\Stock;
use Carbon\Carbon;
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

class StockHistoryController extends Controller
{
    public function show($ticker)
    {
        $stockHistory = Stock::where('ticker',$ticker)->first()->history()->orderBy('date','desc')->paginate(30);
        if ($stockHistory->isEmpty())
            return view('stock-history')->with('message','nao encontrado')->with(compact('ticker'));
        // codigo para funcionar a var $loop->iteration mesmo com paginaçao. Copiado da internet
        $skipped = ($stockHistory->currentPage() * $stockHistory->perPage()) - $stockHistory->perPage();
        //$period['begin']=0;
        // $period['end']=$stockHistory->first()->date;
        
        return view('stock-history')->with(compact('ticker','stockHistory','skipped','period'));
    }

    public function update(Request $request,$ticker)
    {
        //TODO: verificar se a data de inicio é posterior a data atual e limitar uma data limite de inicio. 
        $beginDate = $request->beginDate;
        $endDate = date('d/m/Y'); //data final é sempre a data atual
        
        //recupera o id a partir do ticker - necessario para criar o historico
        $stock = Stock::where('ticker',$ticker)->first();
        
        if (! $stock) //se nao existe eh pq o ticker eh invalido 
            return 'Codigo '.$ticker.' não encontrato na base de dados'; 

        //chama o metodo que faz o scrap na pagina do UOL passando as datas de inicio e fim (d/m/Y)      
        $pricesHistory = $this->scrapUol($ticker,$beginDate,$endDate);
        
        //abre uma transaçao para inserir os dados
        //TODO: passar interaçao com banco para dentro da MODEL
        \DB::transaction(function () use ($pricesHistory,$stock){
            foreach ($pricesHistory as $priceHistory){
                try { 
                    HistoryStock::firstOrCreate(['stock_id'=>$stock->id, 
                                        'date'=>$priceHistory['date'],
                                        'closed'=>$priceHistory['closed'],
                                        'min'=>$priceHistory['min'],
                                        'max'=>$priceHistory['max'],
                                        'var'=>$priceHistory['var'],
                                        'var_percent'=>$priceHistory['varPercent'],
                                        ]);
                }
                catch (\Exception $e) {
                    dd($e->getMessage());
                }
            }
            
            //buscar a data de inicio e fim do historico de cotação
            $firstHistory = HistoryStock::where('stock_id',$stock->id)->orderBy('date','asc')->limit(1)->pluck('date')->get(0);
            $lastHistory = HistoryStock::where('stock_id',$stock->id)->orderBy('date','desc')->limit(1)->pluck('date')->get(0);
            
            //atualizar essas datas na tabela stock
            $stock->first_history = $firstHistory;
            $stock->last_history = $lastHistory;
            $stock->save();
        });
        return redirect()->route('stock-history.show',['ticker'=>$ticker]);

    }

    // Faz scrap no site da UOL
    // TODO: implementar try catch
    public function scrapUol($ticker,$beginDate,$endDate)
    {
        $client = new Client();
        //faz o parse das datas para o formato esperado pela URL
        // TODO: verificar se a data recebida está no padrao d/m/Y - se nao irá dar erro ao formar a URL (fazer com request!! ver exemplo no mybudget)
        $parts = explode('/',$beginDate);
        $begin['day'] = $parts[0];
        $begin['month'] = $parts[1];
        $begin['year'] = $parts[2];
        $parts = explode('/',$endDate);
        $end['day'] = $parts[0];
        $end['month'] = $parts[1];
        $end['year'] = $parts[2];
        
        $url = 'http://cotacoes.economia.uol.com.br/acao/cotacoes-historicas.html?'.
                    'codigo='.$ticker.'.SA'.
                    '&beginDay='.$begin['day'].
                    '&beginMonth='.$begin['month'].
                    '&beginYear='.$begin['year'].
                    '&endDay='.$end['day'].
                    '&endMonth='.$end['month'].
                    '&endYear='.$end['year'].
                    '&size=10000&page=1';
        $html = $client->request('GET', $url);
        $htmlTable = $html->filter("table[class='tblCotacoes'] tbody")->html();
        $htmlTable = preg_replace('/(\v|\s)+/', ' ', $htmlTable);
        $crawler = new Crawler($htmlTable);
        
        $pricesHistory = $crawler->filter("tr")->each(function ($node){
            return $this->convertScrapStringToArray($node->text()); 
            //var_dump($priceHistory);
        });
        //retorna um array com uma linha da tabela em cada posição do array
        return $pricesHistory; 
    }

    //metodo para transformar em array a string obtida pelo scraping
    public function convertScrapStringToArray($string)
    {
        $priceHistory = [];
        $parts =  explode(' ',trim($string));
        $priceHistory['date'] = Carbon::createFromFormat('d/m/Y',$parts[0])->toDateString(); //formata para Y-m-d
        $priceHistory['closed'] = str_replace(',','.',$parts[1]);
        $priceHistory['min'] = str_replace(',','.',$parts[2]);
        $priceHistory['max'] = str_replace(',','.',$parts[3]);
        $priceHistory['var'] = str_replace(',','.',$parts[4]);
        $priceHistory['varPercent'] = str_replace(',','.',$parts[5]);
        //$priceHistory['volume'] = $parts[6];
        return $priceHistory;
    }
}
