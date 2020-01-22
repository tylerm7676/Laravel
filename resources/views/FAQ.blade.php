@extends('adminlte::page')

@section('title', 'FAQ')

@section('content_header')
    <h1>FAQ</h1>
    <ol class="breadcrumb">
        <li><a href="home"><i class="fas fa-tachometer-alt"></i> Home</a></li>
        <li class="active">FAQ</li>
    </ol>
@stop

@section('content')

@if (Auth::user()->type == "driver")
<div class="col-sm-12">
    <div class="box box-primary">
        <div class="box-body box-profile"><h4>Driver Account</h4></div>
        <div class="table-responsive box-body">
            <table class="table">
                <tr>
                    <th>Q: How do I view my notifications?</th>
                    <td>A: The notifications can be accessed from the home page and a tab on the left.</td>
                </tr>
                <tr>
                    <th>Q: How do I view my profile page?</th>
                    <td>A: The profile page can be accessed from the home page and a tab on the left.</td>
                </tr>
                <tr>
                    <th>Q: How do I view the catalog?</th>
                    <td>A: The catalog can be accessed from the home page and a tab on the left.</td>
                </tr>
                <tr>
                    <th>Q: How do I view the cart?</th>
                    <td>A: The cart can be accessed from the home page and a tab on the left.</td>
                </tr>
                <tr>
                    <th>Q: How do I view my orders?</th>
                    <td>A: Orders can be accessed from the home page and a tab on the left.</td>
                </tr>
                <tr>
                    <th>Q: How do I change my information?</th>
                    <td>A: Information can be changed on the profile page.</td>
                </tr>
                <tr>
                    <th>Q: How do I submit an application?</th>
                    <td>A: Navigate to the profile page. A link will be on the right side.</td>
                </tr>
                <tr>
                    <th>Q: How do I view my point balance?</th>
                    <td>A: Points can be viewed from home, profile, and checkout pages.</td>
                </tr>
            </table>
        </div>
    </div>
</div>

@elseif (Auth::user()->type == "sponsor")
<div class="col-sm-12">
    <div class="box box-primary">
        <div class="box-body box-profile"><h4>Sponsor Account</h4></div>
        <div class="table-responsive box-body">
            <table class="table">
                <tr>
                    <th>Q: How do I view my profile page?</th>
                    <td>A: The profile page can be accessed from the home page and a tab on the left.</td>
                </tr>
                <tr>
                    <th>Q: How do I view the catalog?</th>
                    <td>A: The catalog can be accessed from the home page and a tab on the left.</td>
                </tr>
                <tr>
                    <th>Q: How do I view applications?</th>
                    <td>A: Navigate to the profile page from the home page or a tab on the left. Applications will be on the bottom of the page.</td>
                </tr>
                <tr>
                    <th>Q: How do I view drivers associated with my company?</th>
                    <td>A: Navigate to the drivers page from the home page or a tab on the left.</td>
                </tr>
                <tr>
                    <th>Q: How do I view drivers profiles?</th>
                    <td>A: On the drivers page select the driver with the view profile button.</td>
                </tr>
                <tr>
                    <th>Q: How do I change my information?</th>
                    <td>A: Information can be changed on the profile page.</td>
                </tr>
                <tr>
                    <th>Q: How do I change a drivers point balance?</th>
                    <td>A: On the drivers page there is a "Add Points" button. It will then prompt to enter points with a minus to deduct points or plus to add points.</td>
                </tr>
                <tr>
                    <th>Q: How do I remove a driver?</th>
                    <td>A: On the drivers page there is a "Remove Driver" button.</td>
                </tr>
                <tr>
                    <th>Q: How do I change catagory rules for the catalog?</th>
                    <td>A: On the catalog page there will be a setting to add or remove a catagory.</td>
                </tr>
            </table>
        </div>
    </div>
</div>

@elseif (Auth::user()->type == "admin")
<div class="col-sm-12">
    <div class="box box-primary">
        <div class="box-body box-profile"><h4>Admin Account</h4></div>
        <div class="table-responsive box-body">
            <table class="table">
                <tr>
                    <th>Q: How do I view my profile page?</th>
                    <td>A: The profile page can be accessed from the home page and a tab on the left.</td>
                </tr>
                <tr>
                    <th>Q: How do I change my information?</th>
                    <td>A: Information can be changed on the profile page.</td>
                </tr>
                <tr>
                    <th>Q: How do I view drivers profiles?</th>
                    <td>A: On the drivers page select the driver with the view profile button.</td>
                </tr>
                <tr>
                    <th>Q: How do I view sponsors profiles?</th>
                    <td>A: On the sponsors page select the sponsor with the view profile button.</td>
                </tr>
                <tr>
                    <th>Q: How do I view admin profiles?</th>
                    <td>A: On the admins page select the admin with the view profile button.</td>
                </tr>
                <tr>
                    <th>Q: How do I view a company's catalog?</th>
                    <td>A: The catalog can be accessed from the home page and a tab on the left.</td>
                </tr>
                <tr>
                    <th>Q: How do I view drivers associated with a company?</th>
                    <td>A: Navigate to the drivers page from the home page or a tab on the left. The name of the associated sponsors will be listed.</td>
                </tr>
                <tr>
                    <th>Q: How do I print a list of drivers?</th>
                    <td>A: Navigate to the drivers page from the home page or a tab on the left. A "Generate PDF" button will be displayed.</td>
                </tr>
                <tr>
                    <th>Q: How do I print a list of sponsors?</th>
                    <td>A: Navigate to the sponsors page from the home page or a tab on the left. A "Generate PDF" button will be displayed.</td>
                </tr>
                <tr>
                    <th>Q: How do I print a list of admins?</th>
                    <td>A: Navigate to the admins page from the home page or a tab on the left. A "Generate PDF" button will be displayed.</td>
                </tr>
                <tr>
                    <th>Q: How do I remove a driver?</th>
                    <td>A: On the drivers page there is a "Remove Driver" button.</td>
                </tr>
                <tr>
                    <th>Q: How do I remove a sponsor?</th>
                    <td>A: On the drivers page there is a "Remove Sponsor" button.</td>
                </tr>
                <tr>
                    <th>Q: How do I remove an admin?</th>
                    <td>A: On the drivers page there is a "Remove Admin" button.</td>
                </tr>
                <tr>
                    <th>Q: How do I change catagory rules for the catalog?</th>
                    <td>A: On the catalog page there will be a setting to add or remove a catagory.</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endif
@stop

@extends('footer')
