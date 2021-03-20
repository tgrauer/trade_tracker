@extends('layouts.app')

@section('content')
<div class="container bg">
    <div class="row">
        <div class="col-sm-6">

            <form action="#" method="POST" class="form search_ticker">
                <h3 class="mb-3">Add a Day Trade</h3>
                <div class="form-group mb-0">
                    <input type="text" class="form-control search" name="search" placeholder="Search by Ticker or Company Name" autocomplete="off" required>
                </div>

                <div class="search_results"></div>

                <div class="form-group mt-3">
                    <input type="text" class="form-control datepicker" name="date" readonly required placeholder="Add Date" autocomplete="off">
                </div>

                <button class="btn btn-primary btn-lg mt-2">Add Trade</button>
            </form>

            <div class="alert alert-danger hidetilloaded">No Results Found</div>
            
        </div>

        <div class="col-sm-6">
            <h3 class="mb-3">Available Day Trades</h3>

            <div class="row">

                <div class="col-sm-4">
                    <div class="day_trades mt-3 traded">AAPL</div>
                </div>
                
                <div class="col-sm-4">
                    <div class="day_trades mt-3">2</div>
                </div>

                <div class="col-sm-4">
                    <div class="day_trades mt-3">3</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6 offset-6">
            <h3 class="bb">Trade History</h3>
        </div>
    </div>
</div>
@endsection
