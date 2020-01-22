@extends('adminlte::page')

@section('title', 'Profile')

@section('content_header')
    <h1>Profile Management</h1>
    <ol class="breadcrumb">
        <li><a href="home"><i class="fas fa-tachometer-alt"></i> Home</a></li>
        <li class="active">Profile Management</li>
    </ol>
@stop

@section('content')


@if (Auth::user()->type == "driver")
<div class="col-md-4">
    <div class="box box-primary">
        <div class="box-body box-profile">
            <a class="pull-right" href="#update-name" data-toggle="modal" data-target="#update-name"><i class="fas fa-edit"></i></a>
            <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

            <p class="text-muted text-center" style="text-transform: capitalize;">{{ Auth::user()->type }}</p>
            <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                    <b>E-Mail: {{ Auth::user()->email }}</b>
                    <a class="pull-right" href="#update-email" data-toggle="modal" data-target="#update-email"><i class="fas fa-edit"></i></a>
                </li>

                @if (Auth::user()->driver->address != NULL)
                <li class="list-group-item"> <!-- Display Driver's address -->
                    <b>{{ Auth::user()->driver->address->street_address }}<br>
                    {{ Auth::user()->driver->address->city}},
		            {{ Auth::user()->driver->address->state}} 
		            {{ Auth::user()->driver->address->zip_code }}</b>
                    <a class="pull-right" href="#update-address" data-toggle="modal" data-target="#update-address"><i class="fas fa-edit"></i></a>
                </li>

                @else
                <li class="list-group-item"> <!-- Display Driver's address -->
                    <b>No Address on File</b>
                    <a class="pull-right" href="#update-address" data-toggle="modal" data-target="#update-address"><i class="fas fa-edit"></i></a>
                @endif

                <li class="list-group-item">
                    <b>Password:</b>
                    <a class="pull-right" href="#update-password" data-toggle="modal" data-target="#update-password"><i class="fas fa-edit"></i></a>
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- Application Modal -->
<div class="modal fade-in" id="new-application">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Application For Sponsorship</h4>
            </div>
            <div class="modal-body">
                <form role="form" action="{{ url('driver/new-application') }}" method="POST">
                    @csrf
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('sponsor') ? 'has-error' : '' }}">
                            <label>Who would you like to apply with?</label>
                            <select class="form-control" name="sponsor">
                                @foreach($sponsors as $sponsor)
                                <option value="{{ $sponsor->id }}">{{ $sponsor->organization }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('sponsor'))
                            <span class="text-danger">{{ $errors->first('sponsor') }}</span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('explanation') ? 'has-error' : '' }}">
                            <label>Briefly explain why you would like this company to sponsor you.</label>
                            <textarea class="form-control" rows="3" placeholder="Enter ..." name="explanation"></textarea>
                            @if ($errors->has('explanation'))
                            <span class="text-danger">{{ $errors->first('explanation') }}</span>
                            @endif
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <input type="hidden" name="driver" value="{{ Auth::user()->driver->id }}">
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary pull-right">Submit</button>
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
                            <input class="form-control" class="form-control" name="name" id="name" value="{{ Auth::user()->driver->name }}" required>
                            @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <input type="hidden" name="driver_id" value="{{ Auth::user()->driver->id }}">
		    <input type="hidden" name="id" value="{{ Auth::user()->id }}">
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
                            <input class="form-control" class="form-control" name="email" id="email" value="{{ Auth::user()->driver->email }}" required>
                            @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <input type="hidden" name="driver_id" value="{{ Auth::user()->driver->id }}">
                    <input type="hidden" name="id" value="{{ Auth::user()->id }}">
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
                @if (Auth::user()->driver->address != NULL)
                <form id="changeAddress" role="form" action="{{ url('/update-address') }}" method="PUT">
                    @csrf
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('street_address') ? 'has-error' : '' }}">
                            <label for="street_address">Street Address:</label>
                            <input class="form-control" class="form-control" name="street_address" id="street_address" value="{{ Auth::user()->driver->street_address }}" required>
                            @if ($errors->has('street_address'))
                            <span class="text-danger">{{ $errors->first('street_address') }}</span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
                            <label for="city">City:</label>
                            <input class="form-control" class="form-control" name="city" id="city" value="{{ Auth::user()->driver->city }}" required>
                            @if ($errors->has('city'))
                            <span class="text-danger">{{ $errors->first('city') }}</span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('state') ? 'has-error' : '' }}">
                            <label for="state">State:</label>
                            <input class="form-control" class="form-control" name="state" id="state" value="{{ Auth::user()->driver->state }}" required>
                            @if ($errors->has('state'))
                            <span class="text-danger">{{ $errors->first('state') }}</span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('zip_code') ? 'has-error' : '' }}">
                            <label for="zip_code">Zip Code:</label>
                            <input class="form-control" class="form-control" name="zip_code" id="zip_code" value="{{ Auth::user()->driver->zip_code }}" required>
                            @if ($errors->has('zip_code'))
                            <span class="text-danger">{{ $errors->first('zip_code') }}</span>
                            @endif
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <input type="hidden" name="driver" value="{{ Auth::user()->driver->id }}">
		            <input type="hidden" name="id" value="{{Auth::user()->driver->address->id }}">
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
                            <input class="form-control" class="form-control" name="street_address" id="street_address" value="{{ Auth::user()->driver->street_address }}" required>
                            @if ($errors->has('street_address'))
                            <span class="text-danger">{{ $errors->first('street_address') }}</span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
                            <label for="city">City:</label>
                            <input class="form-control" class="form-control" name="city" id="city" value="{{ Auth::user()->driver->city }}" required>
                            @if ($errors->has('city'))
                            <span class="text-danger">{{ $errors->first('city') }}</span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('state') ? 'has-error' : '' }}">
                            <label for="state">State:</label>
                            <input class="form-control" class="form-control" name="state" id="state" value="{{ Auth::user()->driver->state }}" required>
                            @if ($errors->has('state'))
                            <span class="text-danger">{{ $errors->first('state') }}</span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('zip_code') ? 'has-error' : '' }}">
                            <label for="zip_code">Zip Code:</label>
                            <input class="form-control" class="form-control" name="zip_code" id="zip_code" value="{{ Auth::user()->driver->zip_code }}" required>
                            @if ($errors->has('zip_code'))
                            <span class="text-danger">{{ $errors->first('zip_code') }}</span>
                            @endif
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <input type="hidden" name="driver" value="{{ Auth::user()->driver->user_id }}">
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
{{--                        <div class="form-group {{ $errors->has('oldpassword') ? 'has-error' : '' }}">
                            <label for="oldpassword">Old Password:</label>
                            <input class="form-control" class="form-control" name="oldpassword" id="oldpassword" type="password" required>
                            @if ($errors->has('oldpassword'))
                            <span class="text-danger">{{ $errors->first('oldpassword') }}</span>
                            @endif
                        </div>
--}}
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
                    <input type="hidden" name="id" value="{{ Auth::user()->driver->user_id }}">
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

<div class="col-md-8">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#sponsorship" data-toggle="tab">Sponsorship</a></li>
            <!--<li><a href="#timeline" data-toggle="tab">Timeline</a></li>
            <li><a href="#settings" data-toggle="tab">Settings</a></li>-->
        </ul>
        <div class="tab-content">
            <div class="active tab-pane" id="sponsorship">
                <h4>Current Sponsorship Information</h4>
                <ul class="list-group list-group-unbordered">
                    @php $hasSponsor = false; @endphp
                    @foreach(Auth::user()->driver->sponsors as $sponsor)
                        @php $hasSponsor = true; @endphp
                        <li class="list-group-item">
                            <b>{{$sponsor->organization}}</b><b class="pull-right">Point Balance: {{$sponsor->pivot->points_balance}}</b>
                        </li>
                    @endforeach
                    @if ($hasSponsor == false)
                        <span class="pull-right-container">
                            <small class="label bg-red">You must associate with a sponsor!</small>
                        </span>
                    @endif
                </ul>
                <div class="box-footer clearfix">
                    <button type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#new-application"><i class="fa fa-plus"></i> New Sponsorship Application</button>
                </div>
            </div>
            <div class="tab-pane" id="settings">
                Room for more driver settings and info here.
            </div>
        </div>
    </div>
</div>


@elseif (Auth::user()->type == "sponsor")
<div class="col-md-4">
    <div class="box box-primary">
        <div class="box-body box-profile">
            <a class="pull-right" href="#update-name" data-toggle="modal" data-target="#update-name"><i class="fas fa-edit"></i></a>
            <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

            <p class="text-muted text-center" style="text-transform: capitalize;">{{ Auth::user()->type }}</p>
            <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                    <b>E-Mail: {{ Auth::user()->email }}</b>
                    <a class="pull-right" href="#update-email" data-toggle="modal" data-target="#update-email"><i class="fas fa-edit"></i></a>
                </li>
                <li class="list-group-item">
                    @php $numdrivers = 0; @endphp
                    @foreach(Auth::user()->sponsor->drivers as $driver)
                    @php $numdrivers++; @endphp
                    @endforeach
                    <b>Number of Drivers: {{ $numdrivers}}</b>
                    <a class="pull-right" href="driverlist"><i class="fas fa-edit"></i></a>
                </li>
                <li class="list-group-item">
                    <b>Point Conversion: {{ Auth::user()->sponsor->conversion }}</b>
                    <a class="pull-right" href="#update-conversion" data-toggle="modal" data-target="#update-conversion"><i class="fas fa-edit"></i></a>
                </li>
                <li class="list-group-item">
                    <b>Company Information: {{ Auth::user()->sponsor->info }}</b>
                    <a class="pull-right" href="#update-info" data-toggle="modal" data-target="#update-info"><i class="fas fa-edit"></i></a>
                </li>
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
                            <input class="form-control" class="form-control" name="name" id="name" value="{{ Auth::user()->sponsor->name }}" required>
                            @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <input type="hidden" name="sponsor_id" value="{{ Auth::user()->sponsor->id }}">
                    <input type="hidden" name="id" value="{{ Auth::user()->id }}">
		    <input type="hidden" name="type" value="sponsor">
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
                <form id=changeEmail role="form" action="{{ url('/update-email') }}" method="PUT">
                    @csrf
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label for="email">E-Mail:</label>
                            <input class="form-control" class="form-control" name="email" id="email" value="{{ Auth::user()->sponsor->email }}" required>
                            @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <input type="hidden" name="sponsor_id" value="{{ Auth::user()->sponsor->id }}">
                    <input type="hidden" name="id" value="{{ Auth::user()->id }}">
		    <input type="hidden" name="type" value="sponsor">
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

<!-- Update Conversion -->
<div class="modal fade-in" id="update-conversion">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <center><h4 class="modal-title">Update Point Conversion</h4></center>
            </div>
            <div class="modal-body">
                <form id=changeConversion role="form" action="{{ url('/update-conversion') }}" method="PUT">
                    @csrf
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('conversion') ? 'has-error' : '' }}">
                            <label for="conversion">Conversion Factor - Points per $1 - XX.XX (Example: 12.34)</label>
                            <input class="form-control" class="form-control" name="conversion" id="conversion" value="{{ Auth::user()->sponsor->conversion }}" required>
                            @if ($errors->has('conversion'))
                            <span class="text-danger">{{ $errors->first('conversion') }}</span>
                            @endif
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <input type="hidden" name="sponsor_id" value="{{ Auth::user()->sponsor->id }}">
                    <input type="hidden" name="id" value="{{ Auth::user()->id }}">
            <input type="hidden" name="type" value="sponsor">
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

<!-- Update Company Information -->
<div class="modal fade-in" id="update-info">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <center><h4 class="modal-title">Update Company Information</h4></center>
            </div>
            <div class="modal-body">
                <form id=changeInfo role="form" action="{{ url('/update-info') }}" method="PUT">
                    @csrf
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('info') ? 'has-error' : '' }}">
                            <label for="info">Company Information (250 Char. Max):</label>
                            <input class="form-control" class="form-control" name="info" id="info" value="{{ Auth::user()->sponsor->info }}" required>
                            @if ($errors->has('info'))
                            <span class="text-danger">{{ $errors->first('info') }}</span>
                            @endif
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <input type="hidden" name="sponsor_id" value="{{ Auth::user()->sponsor->id }}">
                    <input type="hidden" name="id" value="{{ Auth::user()->id }}">
            <input type="hidden" name="type" value="sponsor">
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
{{--                        <div class="form-group {{ $errors->has('oldpassword') ? 'has-error' : '' }}">
                            <label for="oldpassword">Old Password:</label>
                            <input class="form-control" class="form-control" name="oldpassword" id="oldpassword" type="password" required>
                            @if ($errors->has('oldpassword'))
                            <span class="text-danger">{{ $errors->first('oldpassword') }}</span>
                            @endif
                        </div>
--}}
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
                    <input type="hidden" name="id" value="{{ Auth::user()->sponsor->user_id }}">
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

<!-- Create New Organization -->
<div class="modal fade-in" id="new-organization">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <center><h4 class="modal-title">New Organization</h4></center>
            </div>
            <div class="modal-body">
                <form role="form" action="{{ url('update-orgname') }}" method="PUT">
                    @csrf
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name">Organization Name:</label>
                            <input class="form-control" class="form-control" name="name" id="name" type="name" required>
                            @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <input type="hidden" name="sponsor" value="{{ Auth::user()->sponsor->id }}">
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

<div class="col-md-8">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#sponsorship" data-toggle="tab">Sponsorship</a></li>
        </ul>
        <div class="tab-content">
                <div class="card-header">Sponsor Account Profile</div>
                @if( Auth::user()->sponsor->organization != '')
                <div class="card-body">Organization: {{ Auth::user()->sponsor->organization }}</div>
                @else
                <div class="card-body"><a href="#new-organization" data-toggle="modal" data-target="#new-organization">Create New Organization</a></div>
                @endif
            </div>
        </div>
    </div>
</div>


@elseif (Auth::user()->type == "admin")
<div class="col-md-4">
    <div class="box box-primary">
        <div class="box-body box-profile">
            <a class="pull-right" href="#update-name" data-toggle="modal" data-target="#update-name"><i class="fas fa-edit"></i></a>
            <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

            <p class="text-muted text-center" style="text-transform: capitalize;">{{ Auth::user()->type }}</p>
            <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                    <b>E-Mail: {{ Auth::user()->email }}</b>
                    <a class="pull-right" href="#update-email" data-toggle="modal" data-target="#update-email"><i class="fas fa-edit"></i></a>
                </li>
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
                <form role="form" action="{{ url('/update-name') }}" method="PUT">
                    @csrf
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name">Name:</label>
                            <input class="form-control" class="form-control" name="name" id="name" value="{{ Auth::user()->name }}" required>
                            @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="admin_id" value="{{Auth::user()->admin->user_id }}">
		    <input type="hidden" name="type" value="{{Auth::user()->type }}">
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
                <form role="form" action="{{ url('/update-email') }}" method="PUT">
                    @csrf
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label for="email">E-Mail:</label>
                            <input class="form-control" class="form-control" name="email" id="email" value="{{ Auth::user()->email }}" required>
                            @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <input type="hidden" name="sponsor_id" value="{{ Auth::user()->admin->id }}">
                    <input type="hidden" name="id" value="{{ Auth::user()->id }}">
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
{{--                        <div class="form-group {{ $errors->has('oldpassword') ? 'has-error' : '' }}">
                            <label for="oldpassword">Old Password:</label>
                            <input class="form-control" class="form-control" name="oldpassword" id="oldpassword" type="password" required>
                            @if ($errors->has('oldpassword'))
                            <span class="text-danger">{{ $errors->first('oldpassword') }}</span>
                            @endif
                        </div>
--}}
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
                     <input type="hidden" name="id" value="{{ Auth::user()->admin->user_id }}">
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

@section('js')
<script type="text/javascript">
    $(window).on('load',function(){

        if($errors->first() == "password"){
            $('#update-password').modal('show');
        }
            
        /*if({{ count($errors) }} !== 0) {
            $('#update-password').modal('show');
        }*/
    });
</script>
@stop
