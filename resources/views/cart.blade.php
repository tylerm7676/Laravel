@extends('adminlte::page')

@section('title', 'Cart')

@section('content_header')
    <h1>Cart</h1>
    <ol class="breadcrumb">
        <li><a href="home"><i class="fas fa-tachometer-alt"></i> Home</a></li>
        <li class="active">Cart</li>
    </ol>
@stop

@section('content')

@if (Auth::user()->type == "driver")
<div class="col-sm-12">
    <div class="box box-primary">
        <div class="box-body box-profile">
            <h4>Driver Account</h4>
        </div>
        <div class="table-responsive box-body">
            <table class="table">
            <thead>
                <tr>
                    <th>Qty</th>
                    <th>Product</th>
                    <th>Subtotal</th>
                    <th>Shipping</th>
                    <th>Remove Item</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                <tr>
                    <td>1</td>
                    <td>{{$item->title}}</td>
                    <td> {{$item->price}} </td>
                    <td>0</td>
                    <td><button type="submit" class="btn btn-primary">Remove Item</button></td>
                </tr>
                @endforeach
            </tbody>
            </table>
        </div>
        <div class="box-body">
            <center>
                <a href="checkout"><button type="submit" class="btn btn-primary" href="/checkout">Proceed to Checkout</button></a>
            </center>
        </div>
    </div>
</div>
@endif
@stop

@extends('footer')
