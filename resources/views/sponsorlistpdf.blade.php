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
                    <th>Profile</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sponsors as $sponsor)
                <tr>
                    <td>{{$sponsor->username}}</td>
                    <td>{{$sponsor->email}}</td> 
                    <td>{{$sponsor->user_id}}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif
