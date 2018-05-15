<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stock;

class GraficoController extends Controller
{
    public function historicoCotacao($acao)
    {
        // echo mktime(0, 0, 0, 1, 2, 2018)*1000;
        // dd();
        // dd(gmdate('Y-m-d H:i:s', strtotime('2018-01-02')));

        $stock = Stock::where('ticker',$acao)->first();
        // $stockHistory = Stock::where('ticker','PETR4')->first()->history()->orderBy('date','asc')->get();//->pluck('date','closed');
        $result = \DB::table('history_stocks')
                    ->select('date','closed')
                    ->where('stock_id','=',$stock->id)
                    ->orderBy('date', 'ASC')
                    // ->limit(3)
                    ->get()
                    ->toArray();
                    
        $array = [];
        foreach ($result as $value){
            $dateParts = explode('-',$value->date);
            // $array[] = array(strtotime($value->date),(float)$value->closed);
            // $array[] = array($value->date,(float)$value->closed);
            //  $array[] = array('Date.UTC('.$dateParts[0].','.$dateParts[1].','.$dateParts[2].')',(float)$value->closed);
            $array[] = array(mktime(0, 0, 0, $dateParts[1], $dateParts[2], $dateParts[0])*1000,(float)$value->closed);
        }
        // dd($array);
        // return $result;//->json($result);
        return $array;

        // return view('home');

    }
}
