@extends('adminlte::page')

@section('title', 'Catalog')

@section('content_header')
    <h1>Catalog</h1>
    <ol class="breadcrumb">
        <li><a href="home"><i class="fas fa-tachometer-alt"></i> Home</a></li>
        <li class="active">Catalog</li>
    </ol>
@stop

@section('content')

@if (Auth::user()->type == "driver")
<form id="search" role="form" action="{{ url('/catalog')}}" method="GET">
@csrf
    <div class="form-group">
        <label>Which Sponsor do you want to view the catalog of?</label>
        <select class="form-control" name="sponsor_index" onchange="this.form.submit()">
        @foreach (Auth::user()->driver->sponsors as $sponsor)
            <option value="{{$sponsor->id}}">{{ $sponsor->organization}}</option>
        @endforeach
        </select>
    </div>
</form>
<br>

@foreach($items as $item)
<div class="col-md-4">
    <div class="box box-primary">
        <div class="box-body box-profile">
            <h4>{{ $item->title }}</h4>
            <img src="{{$item->thumbnail_url}}">
            {{ $item->price }} Points
            <form id="add-product" role="form" action="{{ url('/cart/add/') }}" method="GET">
                <input type="hidden" name="item_id" value="{{ $item->id}}">
                <input type="hidden" name="driver_id" value=" {{Auth::user()->driver->id }}">
                <input type="hidden" name="quantity" value="1">
                <button type="submit" class="btn btn-info btn-flat pull-right"><i class="fas fa-fw fa-shopping-cart "></i> Add to Cart</button>
            </form>
        </div>
    </div>
</div>
@endforeach
   
@elseif (Auth::user()->type == "sponsor")
<form id="search" role="form" action="{{ url('/ebay/search')}}" method="GET">
@csrf
    <div class="input-group input-group-sm">
        <input type="text" class="form-control" placeholder="Search for new products" name="querystr" id="querystr">
            <span class="input-group-btn">
                    <button type="submit" class="btn btn-info btn-flat">Go!</button>
            </span>
    </div>
</form>
<br>
@foreach(Auth::user()->sponsor->items as $item)
<div class="col-md-4">
    <div class="box box-primary">
        <div class="box-body box-profile">
            <h4>{{ $item->title }}</h4>
            <img src="{{$item->thumbnail_url}}">
            {{ $item->price*Auth::user()->sponsor->conversion }} Points
        </div>
    </div>
</div>
@endforeach

@elseif (Auth::user()->type == "admin")
<div class="col-sm-12">
    <div class="box box-primary">
        <div class="box-body box-profile">
            <h4>Admin Account</h4>
            {{ $items }}
        </div>
    </div>
</div>
@endif
@stop

@extends('footer')
