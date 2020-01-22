@extends('adminlte::page')

@section('title', 'Checkout')

@section('content_header')
<h1>Checkout</h1>
<ol class="breadcrumb">
	<li><a href="cart"><i class="fas fa-tachometer-alt"></i> Cart</a></li>
<li class="active">Checkout</li>
</ol>
@stop

@section('content')

@if (Auth::user()->type == "driver")
<div class="col-sm-8">
	<div class="box box-primary">
		<div class="box-body box-profile">
			<h4>Driver Account</h4>
		</div>
		<div class="box-body">
			<select name="type" id="type" class="form-control">
				@foreach(Auth::user()->driver->sponsors as $sponsor)
                <option value="{{ $sponsor->id }}">{{ $sponsor->organization }}</option>
                @endforeach
			</select>
		</div>
		<div class="table-responsive box-body">
			<table class="table">
				<tr>
					<th>Point Balance:</th>
					<td>{{ Auth::user()->driver->sponsors[0]->pivot->points_balance }}</td>
				</tr>
				<tr>
					<th>Point Cost:</th>
					<td>{{$total}} Points </td>
				</tr>
			</table>
		</div>
		<div class="box-body">
			<center>
				<form role="form" action="{{ url('order/new')}}"
					<a href="submit"><button type="button" class="btn btn-success"><i class="fa fa-credit-card"></i> Submit Payment
					</button></a>
				</form>
			</center>
		</div>
	</div>
</div>
@endif
@stop

@extends('footer')
