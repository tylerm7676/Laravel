@extends('adminlte::page')

@section('title', 'Driver Profile')

@section('content_header')
    <h1>Driver Profile</h1>
    <ol class="breadcrumb">
        <li><a href="driverlist"><i class="fas fa-tachometer-alt"></i> Driver List</a></li>
        <li class="active">Driver Profile</li>
    </ol>
@stop

@section('content')

@if (Auth::user()->type == "sponsor")
<div class="col-md-4">
    <div class="box box-primary">
        <div class="box-body box-profile">
            <a class="pull-right" href="#update-name" data-toggle="modal" data-target="#update-name"><i class="fas fa-edit"></i></a>
            <h3 class="profile-username text-center">{{ $driver[0]->username }}</h3>

            <p class="text-muted text-center" style="text-transform: capitalize;"></p>
            <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                    <b>E-Mail: {{ $driver[0]->email }}</b>
                    <a class="pull-right" href="#update-email" data-toggle="modal" data-target="#update-email"><i class="fas fa-edit"></i></a>
                </li>
                <li class="list-group-item">
                    <b>Add or Remove Points:</b>
                    <a class="pull-right" href="#update-points" data-toggle="modal" data-target="#update-points"><i class="fas fa-edit"></i></a>
                </li>
                <li class="list-group-item"> <!-- Display Driver's address -->
                    <b>Change Address:</b>
                    <a class="pull-right" href="#update-address" data-toggle="modal" data-target="#update-address"><i class="fas fa-edit"></i></a>
                <li class="list-group-item">
                    <b>Change Password:</b>
                    <a class="pull-right" href="#update-password" data-toggle="modal" data-target="#update-password"><i class="fas fa-edit"></i></a>
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- Update Points -->
<div class="modal fade-in" id="update-points">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <center><h4 class="modal-title">Update Points</h4></center>
            </div>
            <div class="modal-body">
                <form id=changeName role="form" action="{{ url('/update-points') }}" method="PUT">
                    @csrf
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('points') ? 'has-error' : '' }}">
                            <label for="points">Points: to subtract points user - sign </label>
                            <input class="form-control" class="form-control" name="points" id="points" value="" required>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <input type="hidden" name="id" value="{{ $driver[0]->id }}">
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
                    <input type="hidden" name="driver_id" value="">
            <input type="hidden" name="id" value="{{ $driver[0]->user_id }}">
            <input type="hidden" name="type" value="driver">
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
                    <input type="hidden" name="id" value="{{ $driver[0]->user_id }}">
                    <input type="hidden" name="type" value="driver">
            <input type="hidden" name="type" value="driver">
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

<!-- Update Address -->
<div class="modal fade-in" id="update-address">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <center><h4 class="modal-title">Update Address</h4></center>
            </div>
            <div class="modal-body">
                @if ($driver[0]->address_id != NULL)
                <form id="changeAddress" role="form" action="{{ url('/update-address') }}" method="PUT">
                    @csrf
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('street_address') ? 'has-error' : '' }}">
                            <label for="street_address">Street Address:</label>
                            <input class="form-control" class="form-control" name="street_address" id="street_address" value="" required>
                            @if ($errors->has('street_address'))
                            <span class="text-danger">{{ $errors->first('street_address') }}</span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
                            <label for="city">City:</label>
                            <input class="form-control" class="form-control" name="city" id="city" value="" required>
                            @if ($errors->has('city'))
                            <span class="text-danger">{{ $errors->first('city') }}</span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('state') ? 'has-error' : '' }}">
                            <label for="state">State:</label>
                            <input class="form-control" class="form-control" name="state" id="state" value="" required>
                            @if ($errors->has('state'))
                            <span class="text-danger">{{ $errors->first('state') }}</span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('zip_code') ? 'has-error' : '' }}">
                            <label for="zip_code">Zip Code:</label>
                            <input class="form-control" class="form-control" name="zip_code" id="zip_code" value="" required>
                            @if ($errors->has('zip_code'))
                            <span class="text-danger">{{ $errors->first('zip_code') }}</span>
                            @endif
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <input type="hidden" name="id" value="{{ $driver[0]->address_id }}">
                    <div class="box-footer">
                        <center><button type="submit" class="btn btn-primary">Submit</button></center>
                    </div>
                </form>
                @else
                <form id="createAddress" role="form" action="{{ url('/create-address') }}" method="POST">
                    @csrf
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('street_address') ? 'has-error' : '' }}">
                            <label for="street_address">Street Address:</label>
                            <input class="form-control" class="form-control" name="street_address" id="street_address" value="" required>
                            @if ($errors->has('street_address'))
                            <span class="text-danger">{{ $errors->first('street_address') }}</span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
                            <label for="city">City:</label>
                            <input class="form-control" class="form-control" name="city" id="city" value="" required>
                            @if ($errors->has('city'))
                            <span class="text-danger">{{ $errors->first('city') }}</span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('state') ? 'has-error' : '' }}">
                            <label for="state">State:</label>
                            <input class="form-control" class="form-control" name="state" id="state" value="" required>
                            @if ($errors->has('state'))
                            <span class="text-danger">{{ $errors->first('state') }}</span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('zip_code') ? 'has-error' : '' }}">
                            <label for="zip_code">Zip Code:</label>
                            <input class="form-control" class="form-control" name="zip_code" id="zip_code" value="" required>
                            @if ($errors->has('zip_code'))
                            <span class="text-danger">{{ $errors->first('zip_code') }}</span>
                            @endif
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <input type="hidden" name="driver" value="{{ $driver[0]->user_id }}">
                    <div class="box-footer">
                        <center><button type="submit" class="btn btn-primary">Submit</button></center>
                    </div>
                </form>
                @endif
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
                     <input type="hidden" name="id" value="{{ $driver[0]->user_id }}">
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

@elseif (Auth::user()->type == "admin")
<div class="col-md-4">
    <div class="box box-primary">
        <div class="box-body box-profile">
            <a class="pull-right" href="#update-name" data-toggle="modal" data-target="#update-name"><i class="fas fa-edit"></i></a>
            <h3 class="profile-username text-center">{{ $driver[0]->username }}</h3>

            <p class="text-muted text-center" style="text-transform: capitalize;"></p>
            <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                    <b>E-Mail: {{ $driver[0]->email }}</b>
                    <a class="pull-right" href="#update-email" data-toggle="modal" data-target="#update-email"><i class="fas fa-edit"></i></a>
                </li> 
                <li class="list-group-item">
                    <b>Add or Remove Points:</b>
                    <a class="pull-right" href="#update-points" data-toggle="modal" data-target="#update-points"><i class="fas fa-edit"></i></a>
                </li>
                <li class="list-group-item">
                    <b>Change Address:</b>
                    <a class="pull-right" href="#update-address" data-toggle="modal" data-target="#update-address"><i class="fas fa-edit"></i></a>
                <li class="list-group-item">
                    <b>Password:</b>
                    <a class="pull-right" href="#update-password" data-toggle="modal" data-target="#update-password"><i class="fas fa-edit"></i></a>
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- Update Points -->
<div class="modal fade-in" id="update-points">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <center><h4 class="modal-title">Update Points</h4></center>
            </div>
            <div class="modal-body">
                <form id=changeName role="form" action="{{ url('/update-points') }}" method="PUT">
                    @csrf
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('points') ? 'has-error' : '' }}">
                            <label for="points">Points: to subtract points user - sign </label>
                            <input class="form-control" class="form-control" name="points" id="points" value="" required>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <input type="hidden" name="id" value="{{ $driver[0]->id }}">
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
                    <input type="hidden" name="driver_id" value="">
            <input type="hidden" name="id" value="{{ $driver[0]->user_id }}">
            <input type="hidden" name="type" value="driver">
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
                    <input type="hidden" name="id" value="{{ $driver[0]->user_id }}">
                    <input type="hidden" name="type" value="driver">
            <input type="hidden" name="type" value="driver">
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

<!-- Update Address -->
<div class="modal fade-in" id="update-address">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <center><h4 class="modal-title">Update Address</h4></center>
            </div>
            <div class="modal-body">
                @if ($driver[0]->address_id != NULL)
                <form id="changeAddress" role="form" action="{{ url('/update-address') }}" method="PUT">
                    @csrf
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('street_address') ? 'has-error' : '' }}">
                            <label for="street_address">Street Address:</label>
                            <input class="form-control" class="form-control" name="street_address" id="street_address" value="" required>
                            @if ($errors->has('street_address'))
                            <span class="text-danger">{{ $errors->first('street_address') }}</span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
                            <label for="city">City:</label>
                            <input class="form-control" class="form-control" name="city" id="city" value="" required>
                            @if ($errors->has('city'))
                            <span class="text-danger">{{ $errors->first('city') }}</span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('state') ? 'has-error' : '' }}">
                            <label for="state">State:</label>
                            <input class="form-control" class="form-control" name="state" id="state" value="" required>
                            @if ($errors->has('state'))
                            <span class="text-danger">{{ $errors->first('state') }}</span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('zip_code') ? 'has-error' : '' }}">
                            <label for="zip_code">Zip Code:</label>
                            <input class="form-control" class="form-control" name="zip_code" id="zip_code" value="" required>
                            @if ($errors->has('zip_code'))
                            <span class="text-danger">{{ $errors->first('zip_code') }}</span>
                            @endif
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <input type="hidden" name="id" value="{{ $driver[0]->address_id }}">
                    <div class="box-footer">
                        <center><button type="submit" class="btn btn-primary">Submit</button></center>
                    </div>
                </form>
                @else
                <form id="createAddress" role="form" action="{{ url('/create-address') }}" method="POST">
                    @csrf
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('street_address') ? 'has-error' : '' }}">
                            <label for="street_address">Street Address:</label>
                            <input class="form-control" class="form-control" name="street_address" id="street_address" value="" required>
                            @if ($errors->has('street_address'))
                            <span class="text-danger">{{ $errors->first('street_address') }}</span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
                            <label for="city">City:</label>
                            <input class="form-control" class="form-control" name="city" id="city" value="" required>
                            @if ($errors->has('city'))
                            <span class="text-danger">{{ $errors->first('city') }}</span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('state') ? 'has-error' : '' }}">
                            <label for="state">State:</label>
                            <input class="form-control" class="form-control" name="state" id="state" value="" required>
                            @if ($errors->has('state'))
                            <span class="text-danger">{{ $errors->first('state') }}</span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('zip_code') ? 'has-error' : '' }}">
                            <label for="zip_code">Zip Code:</label>
                            <input class="form-control" class="form-control" name="zip_code" id="zip_code" value="" required>
                            @if ($errors->has('zip_code'))
                            <span class="text-danger">{{ $errors->first('zip_code') }}</span>
                            @endif
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <input type="hidden" name="driver" value="{{ $driver[0]->user_id }}">
                    <div class="box-footer">
                        <center><button type="submit" class="btn btn-primary">Submit</button></center>
                    </div>
                </form>
                @endif
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
                     <input type="hidden" name="id" value="{{ $driver[0]->user_id }}">
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
