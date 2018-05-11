<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Murilobd\GoogleFinanceStocks\Facade\GoogleFinanceStocks;
use Murilobd\GoogleFinanceStocks\GoogleFinanceStocksException;

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
        $exchange = 'BVMF';
        $stock = 'PETR4';
        $stock = GoogleFinanceStocks::requestStockInfos($exchange, $stock);
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
