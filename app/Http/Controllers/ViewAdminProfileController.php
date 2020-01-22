<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sponsor;
use App\User;
use App\Driver;
use App\Admin;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use View;


class ViewAdminProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('viewadminprofile');
    }

    public function getAdmin($user_id = null)
    {
          $admin = DB::table('admins')->where('user_id', '=', $user_id)
                       ->get();

        return view('/viewadminprofile') -> with('admin',$admin);

    }
}
