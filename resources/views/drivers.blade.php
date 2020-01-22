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
                    <th>Points</th>
                    <th>Remove</th>
                </tr>
                </thead>
                <tbody>
               @foreach(Auth::user()->sponsor->drivers as $driver)
                <tr>
                    <td>{{$driver->username}}</td> <a class="pull-right"></a>
                    <td>{{$driver->email}}</td> 
                    <input name="user_id" value="$driver->user_id" type="hidden">
                    <td><a href="viewdriverprofile"><button  type="submit" class="btn btn-primary">View Profile</button></a></td>
                    <td><button type="submit" class="btn btn-primary">Remove Driver</button></td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>