<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Util\IEXCloud;

class StockController extends Controller
{
    protected $api;

    public function __construct(IEXCloud $api)
    {
    	$this->api = $api;
    }

    public function index()
    {

    	// $sector_performance = $this->sector_performance();
    	// $data = [
    	// 	'news' => $news,
     //        'sector_performance' => $sector_performance,
     //    ];

     //    return view('home')->with($data);
    }

    public function search(Request $request)
    {
        $search_term = $request->search_term;
    	return $this->api->sendRequest('search/'.$search_term);
    }

    public function addTrade(Request $request)
    {
    	$ticker = $request->ticker;
    }
}
