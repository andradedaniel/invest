<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Murilobd\GoogleFinanceStocks\Facade\GoogleFinanceStocks;
// use Murilobd\GoogleFinanceStocks\GoogleFinanceStocksException;
// use Goutte\Client;
use GuzzleHttp\Client;

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
		$stock = 'PETR4';
		$timeframe = 600;
		$periodo='1d';
		$url = 'http://finance.google.com/finance/getprices?q='.$stock.'&x=BVMF&p='.$periodo.'&i='.$timeframe.'&f=d,c,o,h,l,v';
		$client = new Client();
		$response = $client->request('GET', $url);
		$content = $response->getBody()->getContents();
		
		$content = explode(PHP_EOL,$content);
		array_splice($content, 0, 7);
		array_splice($content, -1, 1);
		// dd($content);
		date_default_timezone_set('America/Sao_Paulo');
		$timestamp = substr($content[0],1,10);
		echo "<table style='border:1px solid black'><thead><tr><th>Data</th><th>close</th><th>high</th><th>low</th><th>open</th><th>volume</th></tr></thead>";
		foreach ($content as $key => $linha)
		{	
			$parts = explode(',',$content[$key]);
			echo "<tr>";
			echo "<td>";
			if ($key==0)
				echo date("d/m/Y H:i:s", $timestamp);
			else
				echo date("d/m/Y H:i:s", $timestamp+($timeframe*(int)$parts[0]));
			echo "</td>";
			echo "<td>";
			echo $parts[1];
			echo "</td>";
			echo "<td>";
			echo $parts[2];
			echo "</td>";
			echo "<td>";
			echo $parts[3];
			echo "</td>";
			echo "<td>";
			echo $parts[4];
			echo "</td>";
			echo "<td>";
			echo $parts[5];
			echo "</td>";
			echo "</tr>";

		}
		echo "</table>";


		// dd($timestamp);
		
		// $content[7]=str_replace($timestamp,date("d.m.Y - H:i:s", $timestamp),$content[7]);
// 		$date = date("d M Y H:i:s");
// // output
// echo strtotime($date);
		dd();
        // dd($stock);
        echo $stock->symbol;
        echo $stock->name;
        echo $stock->low;
        // return view('home');
    }



    /**
	 * Update stock infos from Google Finance API
	 *
	 * @return: $this
	 */
	public function updateFromGoogle()
	{
		$stock = $this->stock;

		// Only update stock infos if last update was more than 15 minutes ago
		// AND if hour is > 10am
		if (Carbon::now()->diffInMinutes($this->updated_at) <= 15 || Carbon::now()->hour < 10)
			return $this;

		try {
			$google_infos = GoogleFinanceStocks::requestStockInfos($stock->exchange, $stock->symbol);
		} catch (GoogleFinanceStocksException $e) {
			Log::emergency('Stock: ' . $stock->symbol . 'Failed updating from google: ' . $e->getMessage());
			return false;
		}

		// If any of those values are empty, means stock isn't opened yet to update values
		if ($google_infos->open == '' || $google_infos->low == '' || $google_infos->high == '')
			return $this;

		$this->update([
			'date' => Carbon::now(),
			'low' => $google_infos->low,
			'high' => $google_infos->high,
			'price' => $google_infos->price,
			'variation' => $google_infos->variation
		]);

		return $this;
	}
}
