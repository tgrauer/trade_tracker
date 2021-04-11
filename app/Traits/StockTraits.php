<?php

namespace App\Traits;
use Trade;
use DB;
use Auth;

trait StockTraits {

	private function getDayTrades()
	{
	    $numb_days_back = 5;
	    $begin_dt_range = today()->subWeekday($numb_days_back);

	    $holidays = $this->checkMarketHolidays($begin_dt_range, today());

	    if ($holidays) {
	        $numb_days_back++;
	        $begin_dt_range = today()->subWeekday($numb_days_back);
	    }

	    $uses_more_than_one = $this->usersHasMultipleBrokers();

	    if ($uses_more_than_one) {
	        $day_trades = DB::table('trades')
	            ->where('user_id', Auth::id())
	            ->where('created_at', '>=', $begin_dt_range)
	            ->orderBy('created_at', 'asc')
	            ->get()
	            ->groupBy('broker')->toArray();
	    } else {
	        $day_trades = DB::table('trades')
	            ->where('user_id', Auth::id())
	            ->where('created_at', '>=', $begin_dt_range)
	            ->orderBy('created_at', 'asc')
	            ->get()->toArray();
	    }


	    return $day_trades;
	}

	private function getTradeHistory($limit = null)
	{
		// DB::enableQueryLog();
		// doesnt return anything from broker table 
		$trades = Auth::user()->trades()->with('broker')->latest()->take($limit)->get();

		//"query" => "select * from `trades` where `trades`.`user_id` = ? and `trades`.`user_id` is not null order by `created_at` desc"
		//   "bindings" => array:1 [▼
		//     0 => 1
		//   ]
		//   "time" => 0.38
		// ]
		// 1 => array:3 [▼
		//   "query" => "select * from `brokers` where `brokers`.`id` in (0)"
		//   "bindings" => []
		//   "time" => 0.23

		return $trades;

		/// not returning anything from brokers table if broker is empty in trades table

		// $trades = DB::table('trades')
  //           ->where('user_id', Auth::id())
  //           ->join('brokers', 'trades.broker', '=', 'brokers.id')
  //           ->whereNotNull('trades.broker')
  //           ->orderBy('created_at', 'desc')
  //           ->take($limit)
  //           ->get();


	    return $trades;
	}

	private function usersHasMultipleBrokers()
	{
	    // check if users has more than one broker
	    $uses_more_than_one = DB::table('users')
	        ->where('id', Auth::id())
	        ->pluck('brokerage');

	        $uses_more_than_one = unserialize($uses_more_than_one[0]);
	        // return $uses_more_than_one[0];
	    if (count($uses_more_than_one) > 1) {
	        return true;
	    }
	}

	private function checkMarketHolidays($begin_dt_range, $today)
	{
	    $holidays = [
	        '2021-04-02', '2021-05-31', '2021-07-05', '2021-09-06', '2021-11-25', '2021-12-24', '2022-01-17', '2022-02-21', '2022-04-15', '2022-05-30', '2022-07-04', '2022-09-05', '2022-11-24', '2022-12-26', '2023-01-02', '2023-01-16', '2023-02-20', '2023-04-07', '2023-05-29', '2023-07-04', '2023-09-04', '2023-11-23', '2023-12-25'
	    ];

	    foreach ($holidays as $h) {
	        if ($h > $begin_dt_range->toDateString() && $h < $today->toDateString()) {
	            return true;
	        }
	    }
	}

	private function getBrokers()
	{

	    // get users brokers
	    $users_brokers = DB::table('users')
	        ->where('id', Auth::id())
	        ->pluck('brokerage');

	    // get broker names from the ids of the users brokers
	    if (!empty($users_brokers[0])) {
	        $users_brokers_array = unserialize($users_brokers[0]);
	        $brokers_arr = [];
	        
	        foreach ($users_brokers_array as $key => $value) {
	            $brokers = DB::table('brokers')
	                ->where('id', $value)
	                ->get();
	            array_push($brokers_arr, $brokers[0]);
	        }

	        return $brokers_arr;
	    } else {
	        return [];
	    }
	}
}

?>