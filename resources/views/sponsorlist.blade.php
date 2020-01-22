@extends('adminlte::page')

@section('title', 'Sponsors')

@section('content_header')
    <h1>Sponsors</h1>
    <ol class="breadcrumb">
        <li><a href="home"><i class="fas fa-tachometer-alt"></i> Home</a></li>
        <li class="active">Sponsors</li>
    </ol>
@stop

@section('content')

@if (Auth::user()->type == "admin")
<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-body box-profile">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>E-Mail</th>
                    <th>Profile</th>
                    <th>Remove</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sponsors as $sponsor)
                <tr>
                    <td>{{$sponsor->username}}</td> <a class="pull-right"></a>
                    <td>{{$sponsor->email}}</td> 
                    <input name="user_id" value="$sponsor->user_id" type="hidden">
                    <td><a href="{{ url('viewsponsorprofile/'.$sponsor->user_id) }}"><button  type="submit" class="btn btn-primary">View Profile</button></a></td>
                    <td><a href="{{ url('remove_Sponsor/'.$sponsor->user_id) }}"><button type="submit" class="btn btn-primary">Remove Sponsor</button></td>
                </tr>
                @endforeach
                </tbody>
            </table>
            <div class="box-body">
                <center>
                    <a href="sponsorlistpdf"><button type="button" class="btn btn-primary" style="margin-right: 5px;">
                    <i class="fa fa-download"></i> Generate PDF
                    </button></a>
                </center>
            </div>
        </div>
    </div>
@endif
@stop

@extends('footer')
