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

class AdminListController extends Controller
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
        $admins = DB::table('users')->where('type','=','admin')
                ->get();

        return view('adminlist') -> with('admins',$admins);
    }

    public function remove_Admin(Request $request){
        DB::table('users')->where('id', '=', $request['id'])->delete();
        DB::table('admins')->where('user_id', '=', $request['id'])->delete();

        return back();
    }
}
