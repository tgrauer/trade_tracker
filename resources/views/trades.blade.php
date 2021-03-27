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
    		            	<th>Type</th>
    		                <th>Ticker</th>
    		                <th>Company</th>
    		                <th>Shares</th>
    		                <th>Price</th>
    		                <th>Option Type</th>
    		                <th>Strike Price</th>
    		                <th>Expiration</th>
    		            </tr>
    		        </thead>

    		        <tbody>
    		            @foreach($trades as $trade)
    		                <tr>
    		                	@php
    		                		$trade_date = \Carbon\Carbon::parse($trade->created_at)->toFormattedDateString();
    		                	if(!empty($trade->expiration_date)){
    		                		$expiration_date = \Carbon\Carbon::parse($trade->expiration_date)->toFormattedDateString();
    		                	}else{
    		                		$expiration_date='';
    		                	}
    		                	@endphp

    		                	<td>{{$trade_date}}</td>
    		                	<td>{{$trade->trade_type}}</td>
    		                    <td>{{$trade->ticker}}</td>
    		                    <td>{{$trade->company_name}}</td>
    		                    <td>{{$trade->numb_shares}}</td>
    		                    <td>{{$trade->purchase_price}}</td>
    		                    <td>{{$trade->option_type}}</td>
    		                    <td>{{$trade->strike_price}}</td>
    		                    <td>{{ $expiration_date ?? '' }}</td>
    		                </tr>
    		            @endforeach
    		        </tbody>
    		    </table>
    		</div>
    	</div>
    </div>
@endsection