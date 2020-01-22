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

class ViewDriverProfileController extends Controller
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
        return view('viewdriverprofile');
    }
    public function getDriver($user_id = null,$address_id = null)
    {
          $driver = DB::table('drivers')->where('user_id', '=', $user_id)
                       ->get();

          $address = DB::table('address')->where('id', '=', $address_id)
                       ->get();

          return view('/viewdriverprofile', compact('address',$address)) -> with('driver',$driver);

    }
}
