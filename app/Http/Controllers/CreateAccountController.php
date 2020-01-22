<?php

namespace App\Http\Controllers;

use App\User;
use App\Driver;
use App\Sponsor;
use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class CreateAccountController extends Controller
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


    public function create_account(Request $data){

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'type' => $data['type'],
        ]);

        if($data['type'] == 'admin'){
            $admin = Admin::create([
                'username' => $data['name'],
            ]);
        }

 //       $admin->user()->associate($user);
 //       $admin->save();

        if ($data['type'] == 'driver') {
            $driver = Driver::create([
                'username' => $data['name'],
                'email' => $data['email'],
                'address_id' => null,
                'sponsoring_org' => '',
            ]);
            
            $driver->user()->associate($user);
            $driver->save();

        } else if ($data['type'] == 'sponsor') {
            $sponsor = Sponsor::create([
                'username' => $data['name'],
                'email' => $data['email'],
                'organization' => '',
                'address_id' => 0,
            ]);

            $sponsor->user()->associate($user);
            $sponsor->save();
        }
        return back();

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('createaccount');
    }
}
