<style>
table {
  width: 100%;
}
</style>

@if (Auth::user()->type == "admin")
<div class="col-md-12">
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
                @foreach($admins as $admin)
                <tr>
                    <td>{{$admin->name}}</td>
                    <td>{{$admin->email}}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif
