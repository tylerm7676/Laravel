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
use PDF;

class PDFController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function driverlist()
    {
        if (Auth::user()->type == "admin") {
        	$drivers = Driver::all();
            $data = ['drivers' => $drivers];
            $pdf = PDF::loadview('driverlistpdf', $data);
			return $pdf->download('driverlist.pdf');
        }
    }

    public function sponsorlist()
    {
        $sponsors = DB::table('sponsors')->get();
        $data = ['sponsors' => $sponsors];
        $pdf = PDF::loadview('sponsorlistpdf', $data);
        return $pdf->download('sponsorlist.pdf');
    }

    public function adminlist()
    {
        $admins = DB::table('users')->where('type','=','admin')->get();
        $data = ['admins' => $admins];
        $pdf = PDF::loadview('adminlistpdf', $data);
        return $pdf->download('adminlist.pdf');
    }
}
