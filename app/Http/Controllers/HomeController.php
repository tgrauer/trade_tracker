<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Util\IEXCloud;
use App\Traits\StockTraits;
use Trade;
use DB;
use Auth;
use Carbon\Carbon;
use Carbon\CarbonTimeZone;

class HomeController extends Controller
{

    use StockTraits;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $data = [
            'css_file' => 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css',
            'js_file' => 'datepicker.js',
            'trades' => $this->getTradeHistory(5),
            'day_trades' => $this->getDayTrades(),
            'brokers' => $this->getBrokers(),
            'uses_more_than_one' => $this->usersHasMultipleBrokers(),
            'page_type' => 'page'
        ];

        return view('home')->with($data);

        // $data=[
        //     'css_file'=>'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css',
        //     'js_file'=>'datepicker.js',
        //     'page_type' => 'page'
        // ];
        
        // return view('trades')->with($data);
    }

    
}
