@extends('layouts.app')

{{-- <?php  
echo '<pre>';
dd($trades);
echo '</pre>';
?> --}}

@section('content')
<div class="container bg">
    <div class="row pt-4">
        <div class="col-sm-3 offset-9">
            <a href="{{ url('/logout') }}" class="btn btn-outline-danger float-right">Log Out</a>
            <a href="{{url('/home')}}" class="btn btn-outline-secondary">Back to Dashboard</a>
        </div>
    </div>

    <div class="row">
    	<div class="col-sm-12">
    		<div class="table-responsive trade_history mt-4">
    		    <table class="table table-striped">
    		        <thead>
    		            <tr>
    		            	<th>Date</th>
    		                <th>Ticker</th>
    		                <th>Company</th>
    		                <th># of Shares</th>
    		                <th>Purchase Price</th>
    		                <th>Current Price</th>
    		            </tr>
    		        </thead>

    		        <tbody>
    		            @foreach($trades as $trade)
    		                <tr>
    		                	@php
    		                	$trade_date = substr($trade->created_at, 0, 10);
    		                	$trade_date = \Carbon\Carbon::parse($trade->created_at)->toFormattedDateString();

    		                	@endphp

    		                	<td>{{$trade_date}}</td>
    		                    <td>{{$trade->ticker}}</td>
    		                    <td>{{$trade->company_name}}</td>
    		                    <td>{{$trade->numb_shares}}</td>
    		                    <td>{{$trade->purchase_price}}</td>
    		                    <td>$0.00</td>
    		                </tr>
    		            @endforeach
    		        </tbody>
    		    </table>
    		</div>
    	</div>
    </div>
@endsection