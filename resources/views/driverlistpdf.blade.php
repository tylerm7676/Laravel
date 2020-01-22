<style>
table {
  width: 100%;
}
</style>

@if (Auth::user()->type == "admin")
<div class="col-sm-12">
    <div class="box box-primary">
        <div class="box-body box-profile">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>E-Mail</th>
                </tr>
                </thead>
                <tbody>
               @foreach($drivers as $driver)
                <tr>
                    <td>{{$driver->username}}</td> <a class="pull-right"></a>
                    <td>{{$driver->email}}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif