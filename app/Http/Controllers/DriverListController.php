<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Sponsor;
use App\User;
use App\Driver;
use App\Admin;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class DriverListController extends Controller
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
        if (Auth::user()->type == "admin"){
            $drivers = Driver::all();
            return view('driverlist') -> with('drivers',$drivers);
        }
        if (Auth::user()->type == "sponsor"){
            $id = Auth::user()->sponsor->id;
            $applications = \App\Application::where('sponsor_id',$id)
                            ->get();
            $sponsor = Sponsor::find($id)->get();
            $drivers = Driver::all();
            return view('driverlist', compact('applications',$applications)) -> with('drivers',$drivers);
        }  
    }

    public function remove_Driver(Request $request){
        DB::table('users')->where('id', '=', $request['user_id'])->delete();
        DB::table('drivers')->where('user_id', '=', $request['user_id'])->delete();

        return back();
    }

    public function sponsor_remove_Driver(Request $request){
        DB::table('driver_sponsor')->where('driver_id', '=', $request['id'])->delete();

        return back();
    }
}
