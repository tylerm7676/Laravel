@extends('adminlte::page')

@section('title', 'Create Account')

@section('content_header')
    <h1>Create Account</h1>
    <ol class="breadcrumb">
        <li><a href="home"><i class="fas fa-tachometer-alt"></i> Home</a></li>
        <li class="active">Create Account</li>
    </ol>
@stop

@section('content')

@if (Auth::user()->type == "sponsor")
<div class="col-md-4">
    <div class="box box-primary">
        <div class="box-body box-profile">
            <h4>Create New Sponsor Account</h4>
        </div>
        <form id="create_account" role="form" action="{{ url('/create_account') }}" method="POST">
    @csrf
    <div class="box-body">
        <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="{{ trans('adminlte::adminlte.full_name') }}">
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="{{ trans('adminlte::adminlte.email') }}">
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}" >
            <input type="password" name="password" class="form-control" placeholder="{{ trans('adminlte::adminlte.password') }}">
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
            <input type="password" name="password_confirmation" class="form-control" placeholder="{{ trans('adminlte::adminlte.retype_password') }}">
            @if ($errors->has('password_confirmation'))
                <span class="help-block">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">                            
            <select name="type" id="type" class="form-control">
                <option value="">Register As</option>
                <option value="sponsor">Sponsor</option>
            </select>
        </div>
    </div>
    <div class="box-footer">
        <center><button type="submit" class="btn btn-primary">Submit</button></center>
    </div>
</form>
    </div>
</div>

@elseif (Auth::user()->type == "admin")
<div class="col-md-4">
    <div class="box box-primary">
        <div class="box-body box-profile">
            <h4>Admin Account</h4>
        </div>
        <form id="create_account" role="form" action="{{ url('/create_account') }}" method="POST">
    @csrf
    <div class="box-body">
        <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
            <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                   placeholder="{{ trans('adminlte::adminlte.full_name') }}">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
            <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                   placeholder="{{ trans('adminlte::adminlte.email') }}">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
            <input type="password" name="password" class="form-control"
                   placeholder="{{ trans('adminlte::adminlte.password') }}">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
            <input type="password" name="password_confirmation" class="form-control"
                   placeholder="{{ trans('adminlte::adminlte.retype_password') }}">
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
            @if ($errors->has('password_confirmation'))
                <span class="help-block">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">                            
            <select name="type" id="type" class="form-control">
                <option value="">Register As</option>
                <option value="driver">Driver</option>
                <option value="sponsor">Sponsor</option>
                <option value="admin">Admin</option>
            </select>
        </div>
    </div>
    <div class="box-footer">
        <center><button type="submit" class="btn btn-primary">Submit</button></center>
    </div>
</form>
    </div>
</div>
@endif
@stop

@extends('footer')
