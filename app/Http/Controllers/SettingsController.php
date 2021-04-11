<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Broker;
use App\User;
use Auth;

class SettingsController extends Controller
{
    public function index()
    {
    	$user_info = DB::table('users')
    		->select('name', 'email', 'phone', 'brokerage')
    		->where('id', Auth::id())
    		->first()
    	;

    	$data=[
    		'page_type' => 'page',
    		'brokers' => $this->getBrokers(),
    		'user_info' => $user_info
    	];

    	return view('settings')->with($data);
    }

    public function getBrokers()
    {
    	return Broker::all();
    }

    public function updateProfile(Request $request)
    {

    	if(!empty($request->brokerage)){
    		$brokerage_text=[];
    		foreach ($request->brokerage as $broker) {
    			array_push($brokerage_text, $broker);
    		}

    		$brokerages = serialize($brokerage_text);
    	}else{
    		$brokerages ='';
    	}
    	
    	$update_profile = DB::table('users')
    	    ->where('id', Auth::id())
    	    ->update(
    	    	array('name' => $request->name,
    	    		'phone' => $request->phone,
    	    		'brokerage' => $brokerages
    	    ));

    	return $update_profile;
    }
}
