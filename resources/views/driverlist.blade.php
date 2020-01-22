@extends('adminlte::page')

@section('title', 'Drivers')

@section('content_header')
    <h1>Drivers</h1>
    <ol class="breadcrumb">
        <li><a href="home"><i class="fas fa-tachometer-alt"></i> Home</a></li>
        <li class="active">Drivers</li>
    </ol>
@stop

@section('content')

@if (Auth::user()->type == "sponsor")
<div class="col-sm-12">
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
               @foreach(Auth::user()->sponsor->drivers as $driver)
                <tr>
                    <td>{{$driver->username}}</td> <a class="pull-right"></a>
                    <td>{{$driver->email}}</td> 
                    <input name="user_id" value="$driver->user_id" type="hidden">
                    <td><a href="{{ url('viewdriverprofile/'.$driver->user_id) }}"><button  type="submit" class="btn btn-primary">View Profile</button></a></td>
                    <td><a href="{{ url('sponsor_remove_Driver/'.$driver->id) }}"><button type="submit" class="btn btn-primary">Remove Driver</button></td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<h1>Applications</h1>
<div class="col-sm-12">
    <div class="box box-primary">
        <div class="box-body box-profile">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Reason</th>
                    <th>Accept/Reject</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($applications as $application)
                @if($application->status == 'open')
                <tr>
                    <td>{{ $application->driver->user->name }}</td>
                    <td>{{ $application->filename }}</td>
                    <td>
                    <div class="pull-right inline-block">
                        <form action=" {{ url('/accept-driver')}} " action="GET">
                            @csrf
                            <input type="hidden" name="sponsor_id" value="{{Auth::user()->sponsor->id }}">
                            <input type="hidden" name="driver_id" value="{{$application->driver->id}}">
                            <button type="submit" class="btn btn-primary">Accept</button>
                        </form>
                        <form action=" {{ url('/reject-driver')}} " action="GET">
                            @csrf
                            <input type="hidden" name="sponsor_id" value="{{Auth::user()->sponsor->id }}">
                            <input type="hidden" name="driver_id" value="{{$application->driver->id}}">
                            <button type="submit" class="btn btn-danger">Reject</button>
                        </form>
                    </div>
                    </td>
                </tr>
                @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@elseif (Auth::user()->type == "admin")
<div class="col-sm-12">
    <div class="box box-primary">
        <div class="box-body box-profile">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>E-Mail</th>
                    <th>Profile</th>
                    <th>Points</th>
                    <th>Remove</th>
                </tr>
                </thead>
                <tbody>
               @foreach($drivers as $driver)
                <tr>
                    <td>{{$driver->username}}</td> <a class="pull-right"></a>
                    <td>{{$driver->email}}</td> 
                    <input name="user_id" value="$driver->user_id" type="hidden">
                    <td><a href="{{ url('viewdriverprofile/'.$driver->user_id) }}"><button  type="submit" class="btn btn-primary">View Profile</button></a></td>
                    <td><a href="{{ url('remove_Driver/'.$driver->user_id) }}"><button type="submit" class="btn btn-primary">Remove Driver</button></td>
                </tr>
                @endforeach
                </tbody>
            </table>
            <div class="box-body">
                <center>
                    <a href="driverlistpdf"><button type="button" class="btn btn-primary" style="margin-right: 5px;">
                    <i class="fa fa-download"></i> Generate PDF
                    </button></a>
                </center>
            </div>
        </div>
    </div>
</div>

<div class="modal fade-in" id="update-points">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <center><h4 class="modal-title">Update Points</h4></center>
            </div>
            <div class="modal-body">
                <form id=changePoints role="form" action="{{ url('/update-points') }}" method="PUT">
                    @csrf
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('points') ? 'has-error' : '' }}">
                            <label for="points">Enter + to Add or - to Subtract followed by points. (Example: +1.00 or -1.00)</label>
                            <input class="form-control" class="form-control" name="points" id="points" value="" required>
                            @if ($errors->has('points'))
                            <span class="text-danger">{{ $errors->first('points') }}</span>
                            @endif
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <input type="hidden" name="driver_id" value="">
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

@endif
@stop

@extends('footer')
