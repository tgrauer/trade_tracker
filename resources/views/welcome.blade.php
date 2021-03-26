@extends('layouts.app')

{{-- <?php  
echo '<pre>';
dd($day_trades);
echo '</pre>';
?> --}}
@section('content')

    @include('shared.navbar')

    {{-- ///hero billboard --}}
    <div class="jumbotron jumbotron-fluid hero">
        <div class="container mt-5">
            <div class="row">
                <div class="col-sm-7">
                    <h1 class="display-4 tagline">FREE Day Trade Tracker</h1>
                    <p class="lead">Avoid getting flagged as a pattern day trader by logging your trades. If you use multiple brokerages to trade, we've got you covered. MyDayTradeTracker provides <b>support for multiple brokerages</b> at a time.</p>
                    <a href="#" class="btn btn-warning btn-lg mt-3">Sign up or something</a>
                </div>

                <div class="col-sm-5 cta">
                    {{-- <div class="card">
                        <form action="#" method="post" class="form">
                            <div class="form-group">
                                <input type="text" class="form-control">
                            </div>
                        </form>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-4 offset-8 mt-4">
                <h4>Trading Tools</h4>
            </div>
        </div>
    </div>

   
 @endsection
