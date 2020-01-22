@extends('adminlte::page')

@section('title', 'Admin Profile')

@section('content_header')
    <h1>Admin Profile</h1>
    <ol class="breadcrumb">
        <li><a href="adminlist"><i class="fas fa-tachometer-alt"></i> Admin List</a></li>
        <li class="active">Admin Profile</li>
    </ol>
@stop

@section('content')

@if (Auth::user()->type == "admin")
<div class="col-md-4">
    <div class="box box-primary">
        <div class="box-body box-profile">
            <a class="pull-right" href="#update-name" data-toggle="modal" data-target="#update-name"><i class="fas fa-edit"></i></a>
            <h3 class="profile-username text-center">{{ $admin[0]->username }}</h3>

            <p class="text-muted text-center" style="text-transform: capitalize;"></p>
            <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                    <b>Change Email: </b>
                    <a class="pull-right" href="#update-email" data-toggle="modal" data-target="#update-email"> <i class="fas fa-edit"></i></a>
                <li class="list-group-item">
                    <b>Password:</b>
                    <a class="pull-right" href="#update-password" data-toggle="modal" data-target="#update-password"><i class="fas fa-edit"></i></a>
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- Update Name -->
<div class="modal fade-in" id="update-name">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <center><h4 class="modal-title">Update Name</h4></center>
            </div>
            <div class="modal-body">
                <form id=changeName role="form" action="{{ url('/update-name') }}" method="PUT">
                    @csrf
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name">Name:</label>
                            <input class="form-control" class="form-control" name="name" id="name" value="" required>
                            @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>
                    <!-- /.box-body -->
                    
            <input type="hidden" name="id" value="{{ $admin[0]->user_id }}">
            <input type="hidden" name="type" value="admin">
                    <div class="box-footer">
                        <center><button type="submit" class="btn btn-primary">Submit</button></center>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Update E-Mail -->
<div class="modal fade-in" id="update-email">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <center><h4 class="modal-title">Update E-Mail</h4></center>
            </div>
            <div class="modal-body">
                <form id="changeEmail" role="form" action="{{ url('/update-email') }}" method="PUT">
                    @csrf
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label for="email">E-Mail:</label>
                            <input class="form-control" class="form-control" name="email" id="email" value="" required>
                            @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <input type="hidden" name="id" value="{{ $admin[0]->user_id }}">
                    <input type="hidden" name="type" value="admin">
            <div class="box-footer">
                        <center><button type="submit" class="btn btn-primary">Submit</button></center>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Update Password -->
<div class="modal fade-in" id="update-password">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <center><h4 class="modal-title">Update Password</h4></center>
            </div>
            <div class="modal-body">
                <form role="form" action="{{ url('/update-password') }}" method="PUT">
                    @csrf
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                            <label for="password">New Password:</label>
                            <input class="form-control" class="form-control" name="password" id="password" type="password" required>
                            @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                            <label for="confirmpassword">Confirm Password:</label>
                            <input class="form-control" class="form-control" name="password_confirmation" id="password_confirmation" type="password" required>
                            @if ($errors->has('password_confirmation'))
                            <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                            @endif
                        </div>
                    </div>
                    <!-- /.box-body -->
                     <input type="hidden" name="id" value="{{ $admin[0]->user_id }}">
                    <div class="box-footer">
                        <center><button type="submit" class="btn btn-primary">Submit</button></center>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

@endif
@stop

@extends('footer')
