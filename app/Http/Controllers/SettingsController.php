<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
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
    	return DB::table('brokers')
    			->get()
    		;
    }

    public function updateProfile(Request $request)
    {

    	$brokerage_text=[];
    	foreach ($request->brokerage as $key => $value) {
    		array_push($brokerage_text, $value);
    	}

    	$update_profile = DB::table('users')
    	    ->where('id', Auth::id())
    	    ->update(
    	    	array('name' => $request->name,
    	    		'phone' => $request->phone,
    	    		'brokerage' => $brokerage_text
    	    ));

    	return $update_profile;
    }
}
