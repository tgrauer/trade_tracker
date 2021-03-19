@extends('layouts.app')

@section('content')
<div class="container bg">
    <div class="row justify-content-center">
        <div class="col-sm-6">
            <form action="#" method="POST" class="form">
                <div class="form-group mb-0">
                    <input type="text" class="form-control search" name="search" placeholder="Search by Ticker or Company Name" autocomplete="off">
                </div>

                <div class="form-group mb-0">
                    <input type="text" class="form-control datepicker" name="date" required placeholder="Add Date" autocomplete="off">
                </div>
            </form>
            <div class="alert alert-danger hidetilloaded">No Results Found</div>
            <div class="search_results"></div>
        </div>

        <div class="col-sm-6">
            <h2>My Trades</h2>
        </div>
    </div>
</div>
@endsection
