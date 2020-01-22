@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fas fa-tachometer-alt"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
@stop

@section('content')

@if (Auth::user()->type == "driver")
<div class="col-md-4">
    <div class="box box-primary">
        <div class="box-body box-profile">
            <h4>Driver Account</h4>
        </div>
        <div class="box-body">
            @php $hasSponsor = false; @endphp
            @foreach(Auth::user()->driver->sponsors as $sponsor)
            @php $hasSponsor = true; @endphp
            <div class="card-body">Sponsor "{{$sponsor->organization}}" Point Balance: {{$sponsor->pivot->points_balance}}</div>
            @endforeach
            
            @if ($hasSponsor == false)
                <div class="box-body">
                    <span class="pull-right-container">
                      <small class="label bg-red">You must associate with a sponsor!</small>
                    </span>
                </div>
            @endif
            <div class="card-body"><a href="/profile">Profile</a></div>
            <div class="card-body"><a href="/catalog">Catalog</a></div>
            <div class="card-body"><a href="/cart">Cart</a></div>
            <div class="card-body"><a href="/orders">Orders</a></div>
            <div class="card-body"><a href="/FAQ">FAQ</a></div>
        </div>
    </div>
</div>

@elseif (Auth::user()->type == "sponsor")
<div class="col-md-4">
    <div class="box box-primary">
        <div class="box-body box-profile">
            <h4>Sponsor Account</h4>
        </div>
        <div class="box-body">
            <div class="card-body"><a href="/profile">Profile</a></div>
            <div class="card-body"><a href="/createaccount">Create Account</a></div>
            <div class="card-body"><a href="/catalog">Catalog</a></div>
            <div class="card-body"><a href="/driverlist">Drivers</a></div>
            <div class="card-body"><a href="/FAQ">FAQ</a></div>
        </div>
    </div>
</div>

@elseif (Auth::user()->type == "admin")
<div class="col-md-4">
    <div class="box box-primary">
        <div class="box-body box-profile">
            <h4>Admin Account</h4>
        </div>
        <div class="box-body">
            <div class="card-body"><a href="/profile">Profile</a></div>
            <div class="card-body"><a href="/createaccount">Create Account</a></div>
            <div class="card-body"><a href="/catalog">Catalog</a></div>
            <div class="card-body"><a href="/driverlist">Drivers</a></div>
            <div class="card-body"><a href="/sponsorlist">Sponsors</a></div>
            <div class="card-body"><a href="/adminlist">Admins</a></div>
            <div class="card-body"><a href="/FAQ">FAQ</a></div>
        </div>
    </div>
</div>
@endif
@stop

@extends('footer')
