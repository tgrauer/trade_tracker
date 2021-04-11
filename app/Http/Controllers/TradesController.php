<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Util\IEXCloud;
use App\Traits\StockTraits;
use Trade;
use DB;
use Auth;
use Carbon\Carbon;
use Carbon\CarbonTimeZone;

class TradesController extends Controller
{
    use StockTraits;

    protected $api;

    public function __construct(IEXCloud $api)
    {
        $this->api = $api;
        $this->middleware('auth');
    }

    public function search(Request $request)
    {
        $search_term = $request->search_term;
        return $this->api->sendRequest('search/' . $search_term);
    }

    public function addTrade(Request $request)
    {
        $created_at = Carbon::createFromDate($request->date_purchased);
        if (!empty($request->expiration_date)) {
            $expiration_date = Carbon::createFromDate($request->expiration_date);
        }

        $post_array = [
            'user_id' => Auth::id(),
            'ticker' => $request->ticker,
            'company_name' => $request->company_name,
            'purchase_price' => $request->purchase_price,
            'created_at' => $created_at
        ];

        if ($request->brokerage) {
            $post_array['broker'] = $request->brokerage;
        }

        // if shares
        if ($request->trade_type == 'shares') {
            $post_array['trade_type'] = 'shares';
            $post_array['numb_shares'] = $request->numb_shares;
        } else if ($request->trade_type == 'options') {
            $post_array['trade_type'] = 'options';
            $post_array['option_type'] = $request->option_type;
            $post_array['expiration_date'] = $expiration_date;
            $post_array['strike_price'] = $request->strike_price;
        }

        // insert trade into db
        $post = DB::table('trades')->insert($post_array);

        return $post;
    }

    public function tradeHistory()
    {
        $data = [
            'trades' => $this->getTradeHistory(),
            'page_type' => 'page'
        ];

        return view('trades')->with($data);
    }

    public function deleteTrade(Request $request)
    {
        DB::table('trades')->where('id', '=', $request->trade_id)->delete();
        return $request->trade_id;
    }
}
