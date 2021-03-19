<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Util\IEXCloud;

class IEXCloudController extends Controller
{
    protected $api;

    public function __construct(IEXCloud $api)
    {
    	$this->api = $api;
    }

    public function getStock($ticker)
    {
    	// $stock_info = $this->api->sendRequest($ticker);
    	// return view('/stock', compact('stock_info'));
    }

    // public function show($id)
    // {
    // 	$post = $this->post->findById($id);

    // 	return view('someview', compact('post'));
    // }
}
