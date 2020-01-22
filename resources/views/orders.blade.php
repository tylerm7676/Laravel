@extends('adminlte::page')

@section('title', 'Orders')

@section('content_header')
    <h1>Orders</h1>
    <ol class="breadcrumb">
        <li><a href="home"><i class="fas fa-tachometer-alt"></i> Home</a></li>
        <li class="active">Orders</li>
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
                    <th>Date</th>
                    <th>Sponsor</th>
                    <th>Points</th>
                    <th>Status</th>
                    <th>Order</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 0; $i < 5; $i++)
                <tr>
                    <td>11/10/19</td>
                    <td>Sponsor 1</td>
                    <td>50</td>
                    <td>Not Delivered</td>
                    <td><button type="submit" class="btn btn-primary">Cancel Order</button></td>
                </tr>
                @endfor
            </tbody>
            </table>
        </div>
    </div>
</div>
@endif
@stop

@extends('footer')
