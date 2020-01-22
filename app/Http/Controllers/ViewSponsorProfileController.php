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

class ViewSponsorProfileController extends Controller
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
    public function getSponsor($user_id = null)
    {
          $sponsor = DB::table('sponsors')->where('user_id', '=', $user_id)
                       ->get();

        return view('/viewsponsorprofile') -> with('sponsor',$sponsor);

    }
}
