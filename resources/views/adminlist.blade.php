@extends('adminlte::page')

@section('title', 'Admins')

@section('content_header')
    <h1>Admins</h1>
    <ol class="breadcrumb">
        <li><a href="home"><i class="fas fa-tachometer-alt"></i> Home</a></li>
        <li class="active">Admins</li>
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
                @foreach($admins as $admin)
                <tr>
                    <td>{{$admin->name}}</td> <a class="pull-right"></a>
                    <td>{{$admin->email}}</td> 
                    <input name="user_id" value="$admin->user_id" type="hidden">
                    <td><a href="{{ url('viewadminprofile/'.$admin->id) }}"><button  type="submit" class="btn btn-primary">View Profile</button></a></td>
                    <td><a href="{{ url('remove_Admin/'.$admin->id) }}"><button type="submit" class="btn btn-primary">Remove Admin</button></td>
                </tr>
                @endforeach
                </tbody>
            </table>
            <div class="box-body">
                <center>
                    <a href="adminlistpdf"><button type="button" class="btn btn-primary" style="margin-right: 5px;">
                    <i class="fa fa-download"></i> Generate PDF
                    </button></a>
                </center>
            </div>
        </div>
    </div>
@endif
@stop

@extends('footer')
