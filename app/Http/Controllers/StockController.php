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
            'trades' => $this->getTrades(),
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
    	$ticker = $request->ticker;
    	$company_name = $request->company_name;
    	$current_price = '100';
    	$purchase_price = $request->purchase_price;
    	$numb_shares = $request->numb_shares;
    	$created_at = $date = Carbon::createFromDate($request->date_purchased);

    	// insert trade into db
    	$post = DB::table('trades')->insert(
    	    [
    	    	'user_id' => Auth::id(),
    	    	'ticker' => $ticker, 
    	    	'company_name' => $company_name,
    	    	'current_price' => $current_price,
    	    	'purchase_price' => $purchase_price,
    	    	'numb_shares' => $numb_shares,
    	    	'created_at' => $created_at
    		]
    	);

    	return $post;
    }

    public function getTrades()
    {
    	$trades = DB::table('trades')->get()->where('user_id', Auth::id());

    	return $trades;
    }
}
