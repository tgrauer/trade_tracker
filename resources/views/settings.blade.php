@extends('layouts.app')
{{-- <?php  
$t = unserialize($user_info->brokerage);
dd($t);
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
    		<h3>Settings</h3>

    		<form action="#" method="POST" class="form update_profile">

    			@csrf

    			<div class="form-group">
    				<label>Name</label>
    				<input type="text" class="form-control" name="name" id="name" value="{{$user_info->name}}">
    			</div>

    			<div class="form-group">
    				<label>Email</label>
    				<input type="text" class="form-control" name="email" id="email" value="{{$user_info->email}}">
    			</div>

    			<div class="form-group">
    				<label>Phone</label>
    				<input type="text" class="form-control" name="phone" id="phone" value="{{$user_info->phone ? $user_info->phone : ''}}" placeholder="Add Phone Number">
    			</div>

    			<div class="form-group">
    				<label>Brokerage</label>
    				<select name="brokerage" id="brokerage" class="form-control selectpicker" multiple>
    					@php
    						$brokerages = unserialize($user_info->brokerage);
    					@endphp

    					@foreach($brokers as $broker)
    						<option {{ in_array($broker->id, $brokerages) ? 'selected' : ' '}} value="{{$broker->id}}">{{$broker->name}}</option>
    					@endforeach
    				</select>
    			</div>

    			<input type="submit" class="btn btn-primary" value="Save Changes">
    		</form>
    	</div>
    </div>
</div>

@include('shared.footer')

@endsection