@extends('adminlte::page')

@section('title', "Catalog Search Results")

@section('content_header')
    <h1>Catalog Search Results</h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/')}}"><i class="fas fa-tachometer-alt"></i> Home</a></li>
        <li><a href="{{ url('/catalog')}}"><i class="fas fa-shopping-cart"></i> Catalog</a></li>
        <li class="active">Search Results</li>
    </ol>
@stop

@section('content')
@foreach($items as $item)
<div class="col-md-4">
    <div class="box box-primary" style="height: 250px;">
        <div class="box-body box-profile">
            <h4>{{ $item->title }}</h4>
            <img src="{{$item->galleryURL}}">
            {{ $item->sellingStatus->currentPrice }}
            <form id="add-product" role="form" action="{{ url('/catalog/new') }}" method="GET">
                <input type="hidden" name="sponsor_id" value="{{ Auth::user()->sponsor->id }}">
                <input type="hidden" name="itemId" value="{{$item->itemId }}">
                <input type="hidden" name="title" value="{{$item->title }}">
                <input type="hidden" name="thumbnail_url" value="{{$item->galleryURL }}">
                <input type="hidden" name="currentPrice" value="{{$item->sellingStatus->currentPrice }}">
                <button type="submit" class="btn btn-info btn-flat pull-right">Add to Catalog</button>
            </form>
        </div>
    </div>
</div>
@endforeach
@stop

@extends('footer')