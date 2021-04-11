@extends('layouts.app')

{{-- <?php
	dd(DB::getQueryLog());
?> --}}

@section('content')
<div class="container bg">
    <div class="row pt-4">
        <div class="col-sm-3 offset-9">
            <a href="{{ url('/logout') }}" class="btn btn-outline-danger float-right">Log Out</a>
            <a href="{{url('/home')}}" class="btn btn-secondary">Back to Dashboard</a>
        </div>
    </div>

    <div class="row">
    	<div class="col-sm-12">
    		<h3 class="mt-5 mb-4">Trade History</h3>
    		<div class="table-responsive trade_history mb-5">

    			@if(empty($trades[0]))
    				<div class="alert alert-info">No trades entered</div>
    			@else
	    		    <table class="table table-striped trade_history_table">
	    		        <thead>
	    		            <tr>
	    		            	<th></th>
	    		            	<th></th>
	    		            	<th>Date</th>
	    		            	<th>Brokerage</th>
	    		                <th>Ticker</th>
	    		                <th>Company</th>
	    		                <th>Type</th>
	    		                <th>Shares</th>
	    		                <th>Price</th>
	    		                <th>Option Type</th>
	    		                <th>Strike Price</th>
	    		                <th>Expiration</th>
	    		            </tr>
	    		        </thead>

	    		        <tbody>

	    		            @foreach($trades as $trade)
	    		                <tr data-trade_id="{{$trade->id}}">
	    		                	@php
	    		                		$trade_date = \Carbon\Carbon::parse($trade->created_at)->toFormattedDateString();
	    		                	if(!empty($trade->expiration_date)){
	    		                		$expiration_date = \Carbon\Carbon::parse($trade->expiration_date)->toFormattedDateString();
	    		                	}else{
	    		                		$expiration_date='';
	    		                	}
	    		                	@endphp

	    		                	<td><a href="#" data-toggle="modal" data-target="#edit_trade_modal" class="edit_trade"><i class="fas fa-edit"></i></a></td>
	    		                	<td><a href="#" data-toggle="modal" data-target="#delete_trade_modal" class="delete_trade"><i class="fas fa-trash-alt"></i></a></td>
	    		                	<td>{{$trade_date}}</td>
	    		                	<td>{{$trade->name}}</td>
	    		                    <td class="trade_ticker">{{$trade->ticker}}</td>
	    		                    <td class="trade_company_name">{{$trade->company_name}}</td>
	    		                    <td>{{$trade->trade_type}}</td>
	    		                    <td>{{$trade->numb_shares}}</td>
	    		                    <td>{{$trade->purchase_price}}</td>
	    		                    <td>{{$trade->option_type}}</td>
	    		                    <td>{{$trade->strike_price}}</td>
	    		                    <td>{{ $expiration_date ?? '' }}</td>
	    		                </tr>
	    		            @endforeach
	    		        </tbody>
	    		    </table>

    		    @endif
    		</div>
    	</div>
    </div>
</div>

@include('shared.footer')

<div class="modal fade" id="edit_trade_modal" tabindex="-1" role="dialog">
 	<div class="modal-dialog" role="document">
    	<div class="modal-content">
     		<div class="modal-header">
        		<h5 class="modal-title">Edit Trade</h5>
    			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
      				<span aria-hidden="true">&times;</span>
    			</button>
      		</div>
	    	<div class="modal-body">
	        	
	     	</div>
	     	<div class="modal-footer">
	        	<button type="button" class="btn btn-primary">Save Changes</button>
	        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
	     	</div>
    	</div>
	</div>
</div>

<div class="modal fade" id="delete_trade_modal" tabindex="-1" role="dialog">
 	<div class="modal-dialog modal-dialog-centered" role="document">
    	<div class="modal-content">
     		<div class="modal-header">
        		<h5 class="modal-title">Delete Trade</h5>
    			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
      				<span aria-hidden="true">&times;</span>
    			</button>
      		</div>
	    	<div class="modal-body">
	        	<p>Are you sure you want to delete <span></span>?</p>
	        	<input type="hidden" class="trade_id" name="trade_id">
	     	</div>
	     	<div class="modal-footer">
	        	<button type="button" class="btn btn-danger delete_trade_submit">Delete Trade</button>
	        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
	     	</div>
    	</div>
	</div>
</div>

@endsection