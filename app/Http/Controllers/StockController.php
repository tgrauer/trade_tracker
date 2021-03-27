<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Util\IEXCloud;
use DB;
use Auth;
use Carbon\Carbon;
use Carbon\CarbonTimeZone;

class StockController extends Controller
{
    protected $api;

    public function __construct(IEXCloud $api)
    {
    	$this->api = $api;
    	$this->middleware('auth');
    }

    public function index()
    {

    	$data=[
            'css_file'=>'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css',
            'js_file'=>'datepicker.js',
            'trades' => $this->getTradeHistory(5),
            'day_trades' => $this->getDayTrades(), 
            'page_type' => 'page'
        ];
        
        return view('home')->with($data);
    }

    public function search(Request $request)
    {
        $search_term = $request->search_term;
    	return $this->api->sendRequest('search/'.$search_term);
    }

    public function addTrade(Request $request)
    {

    	$created_at = Carbon::createFromDate($request->date_purchased);
    	if(!empty($request->expiration_date)){
    		$expiration_date = Carbon::createFromDate($request->expiration_date);
    	}

    	$post_array =[
    		'user_id' => Auth::id(),
    		'ticker' => $request->ticker, 
    		'company_name' => $request->company_name,
    		'purchase_price' => $request->purchase_price,
    		'created_at' => $created_at
    	];    	

    	// if shares
    	if($request->trade_type == 'shares'){
    		$post_array['trade_type'] = 'shares';
    		$post_array['numb_shares'] = $request->numb_shares;
    	}else if($request->trade_type == 'options'){
    		$post_array['trade_type'] = 'options';
    		$post_array['option_type'] = $request->option_type;
    		$post_array['expiration_date'] = $expiration_date;
    		$post_array['strike_price'] = $request->strike_price;
    	}

    	// insert trade into db
    	$post = DB::table('trades')->insert($post_array);

    	return $post;
    }

    public function getTradeHistory($limit=null)
    {
    	$trades = DB::table('trades')
    		->where('user_id', Auth::id())
    		->orderBy('created_at', 'desc')
    		->take($limit)
    		->get()
    	;

    	return $trades;
    }

    public function getDayTrades()
    {
    	
    	$numb_days_back = 5;
    	$now = Carbon::today();
    	$today = Carbon::today();

    	$begin_dt_range = $now->subWeekday($numb_days_back);

    	$holidays = $this->checkMarketHolidays($begin_dt_range, $today);

    	if($holidays){
    		$numb_days_back++;
    		$begin_dt_range = $today->subWeekday($numb_days_back);
    	}

    	$day_trades = DB::table('trades')
			->where('user_id', Auth::id())
			->where('created_at', '>=', $begin_dt_range)
			->orderBy('created_at', 'asc')
			->get()
		;

    	return $day_trades;
    }

    private function checkMarketHolidays($begin_dt_range, $today)
    {
    	$holidays = [
    		'2021-04-02', '2021-05-31', '2021-07-05', '2021-09-06', '2021-11-25', '2021-12-24', '2022-01-17', '2022-02-21', '2022-04-15', '2022-05-30', '2022-07-04', '2022-09-05', '2022-11-24', '2022-12-26', '2023-01-02', '2023-01-16', '2023-02-20', '2023-04-07', '2023-05-29', '2023-07-04', '2023-09-04', '2023-11-23', '2023-12-25'
    	];

    	foreach ($holidays as $h) {
    	    if($h > $begin_dt_range->toDateString() && $h < $today->toDateString()){
    	    	return true;
    	    }
    	}
    }


    public function tradeHistory()
    {
    		$data=[
    	        'trades' => $this->getTradeHistory(),
    	        'page_type' => 'page'
    	    ];
    	return view('trades')->with($data);
    }
}
