@extends('layouts.app')

{{-- <?php  
echo '<pre>';
dd($day_trades);
echo '</pre>';
?> --}}
@section('content')
<div class="container bg">
    <div class="row">
        <div class="col-sm-6">

            <form action="#" method="POST" class="form add_trade">
                @csrf

                <h3 class="mb-3">Add a Day Trade</h3>
                <div class="form-group mb-0">
                    <label class="mb-0">Ticker</label>
                    <input type="text" class="form-control search" name="search" placeholder="Search by Ticker or Company Name" autocomplete="off" required>
                </div>

                <input type="hidden" class="ticker" name="ticker" value="">
                <input type="hidden" class="company_name" name="company_name" value="">

                <div class="search_results"></div>

                <div class="form-group mt-3">
                    <label class="mb-0">Date Purchased</label>
                    <input type="text" class="form-control datepicker date_purchased" name="date_purchased" readonly required autocomplete="off">
                </div>

                <label class="mb-0">Purchase Price</label>
                <div class="input-group mt-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">$</span>
                      </div>
                    <input type="number" class="form-control purchase_price" name="purchase_price" placeholder="Optional" min="0.00" step="0.05" value="1.00" autocomplete="off">
                </div>

                <div class="form-group mt-3">
                    <label class="mb-0"># of shares</label>
                    <input type="number" class="form-control numb_shares" name="numb_shares"  placeholder="Optional" autocomplete="off">
                </div>

                <button class="btn btn-primary btn-lg mt-2">Add Trade</button>
            </form>

            <div class="alert alert-danger hidetilloaded">No Results Found</div>
            
        </div>

        <div class="col-sm-6 mb-5">
            <h3 class="mb-3">Available Day Trades</h3>

            <div class="row d-flex justify-content-around">

                @for($i=0;$i<3;$i++)
                    <div class="col-xs-4">
                        <div class="day_trades mt-3 {{empty($day_trades[$i]->ticker) ? '' : 'traded'}}">{{empty($day_trades[$i]) ? $i +1  : $day_trades[$i]->ticker }}</div>
                    </div> 
                @endfor                
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6 offset-6">
            <h3 class="bb">Trade History</h3>
            <ul class="trade_history pl-3">

                @foreach($trades as $trade)
                    <li class="mb-2"><span class="ticker">{{$trade->ticker}}</span> - <span class="company_name">{{$trade->company_name}}</span> <span class="numb_shares">{{$trade->numb_shares}} </span> - <span class="purchase_price">${{$trade->purchase_price}}</span></li>
                @endforeach
                {{-- <li><span class="ticker">DOW</span> - <span class="company_name">Dow Chemical</span> <span class="numb_shares">5 </span> - <span class="purchase_price">$52.25</span></li>
                <li><span class="ticker">AAPL</span> - <span class="company_name">Apple</span> <span class="numb_shares">8 </span><span class="purchase_price">$78.55</span></li>
                <li><span class="ticker">ABBV</span> - <span class="company_name">Abb Vie</span> <span class="numb_shares">20 </span><span class="purchase_price">$85.90</span></li>
                <li><span class="ticker">NVDA</span> - <span class="company_name">Nvidia</span> <span class="numb_shares">2 </span><span class="purchase_price">$509.53</span></li>
                <li><span class="ticker">IDEX</span> - <span class="company_name">Ideanomixs</span> <span class="numb_shares">100 </span><span class="purchase_price">$2.64</span></li> --}}
            </ul>
        </div>
    </div>
</div>
@endsection
