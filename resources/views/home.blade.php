@extends('layouts.app')

{{-- <?php  
echo '<pre>';
dd($day_trades);
echo '</pre>';
?> --}}
@section('content')
<div class="container bg">
    <div class="row pt-4">
        <div class="col-sm-3 offset-9">
            <a href="{{ url('/logout') }}" class="btn btn-outline-danger float-right">Log Out</a>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-sm-6">
            <div class="card-body">
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

                    <hr/>

                    <h4 class="mb-3">Optional Fields</h4>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input trade_type" type="radio" name="trade_type" id="shares" value="shares">
                        <label class="form-check-label" for="shares">Shares</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input trade_type" type="radio" name="trade_type" id="options" value="options">
                        <label class="form-check-label" for="options">Options</label>
                    </div>

                    <div class="shares hidetilloaded trade_type_form">
                        <div class="form-group mt-3">
                            <label class="mb-0">Purchase Price</label>
                            <div class="input-group mt-0">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                  </div>
                                <input type="text" class="form-control purchase_price" id="purchase_price" name="purchase_price" autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <label class="mb-0"># of shares</label>
                            <input type="number" class="form-control numb_shares" name="numb_shares"  placeholder="Optional" autocomplete="off">
                        </div>
                    </div>

                    <div class="options hidetilloaded trade_type_form">

                        <div class="form-check form-check-inline mt-4">
                            <input class="form-check-input option_type" type="radio" name="option_type" id="call" value="call">
                            <label class="form-check-label" for="call">Call</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input option_type" type="radio" name="option_type" id="put" value="put">
                            <label class="form-check-label" for="put">Put</label>
                        </div>

                        <div class="form-group mt-3">
                            <label class="mb-0">Purchase Price</label>
                            <div class="input-group mt-0">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                  </div>
                                <input type="text" class="form-control purchase_price" id="purchase_price" name="purchase_price" autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <label class="mb-0">Strike Price</label>
                            <div class="input-group mt-0">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                  </div>
                                <input type="text" class="form-control strike_price" id="strike_price" name="purchase_price" autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <label class="mb-0">Expiration</label>
                            <input type="text" class="form-control datepicker expiration_date" name="expiration_date" readonly required autocomplete="off">
                        </div>
                    </div>

                    <button class="btn btn-primary btn-lg mt-3 float-right">Add Trade</button>
                </form>

                <div class="alert alert-danger hidetilloaded">No Results Found</div>
            </div>
            
        </div>

        <div class="col-sm-6 mb-5">
            <h3 class="mb-3">Day Trades Used</h3>

            <div class="row d-flex justify-content-around mb-5">

                @for($i=0;$i<3;$i++)
                    <div class="col-xs-4">
                        <div class="day_trades mt-3 {{empty($day_trades[$i]->ticker) ? '' : 'traded'}}">{{empty($day_trades[$i]) ? $i +1  : $day_trades[$i]->ticker }}</div>
                    </div> 
                @endfor                
            </div>

            <h3 class="mt-4">Trade History</h3>
            <div class="table-responsive trade_history mt-4">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Ticker</th>
                            <th>Trade Type</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($trades as $trade)
                            @php
                                $trade_date = \Carbon\Carbon::parse($trade->created_at)->toFormattedDateString();
                            @endphp
                            <tr>
                                <td>{{$trade_date}}</td>
                                <td>{{$trade->ticker}}</td>
                                <td>{{$trade->trade_type}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


            <a href="{{ url('/trades') }}" class="btn btn-primary mt-3 float-right">View Trade History</a>
        </div>
    </div>
</div>

@include('shared.footer')

@endsection
