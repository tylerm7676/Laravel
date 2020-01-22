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

class SponsorListController extends Controller
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
        $sponsors = DB::table('sponsors')->get();
        return view('sponsorlist') -> with('sponsors',$sponsors);
    }
    public function remove_Sponsor(Request $request){
        DB::table('users')->where('id', '=', $request['user_id'])->delete();
        DB::table('sponsors')->where('user_id', '=', $request['user_id'])->delete();

        return back();
    }
}
