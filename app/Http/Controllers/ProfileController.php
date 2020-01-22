<?php

namespace App\Http\Controllers;

use App\User;
use App\Driver;
use App\Driver_Sponsor;
use App\Sponsor;
use App\Admin;
use App\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
#use Illuminate\Support\Facades\Validator;
use Validator;

class ProfileController extends Controller
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
        $sponsors = Sponsor::all(['id', 'organization']);
        return view('profile', compact('sponsors',$sponsors));
    }

    public function changeEmail(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'unique:users,email',
        ]);
        
        if ($validator->fails()) {
                return back()
                            ->withErrors($validator)
                            ->withInput();
        }

    	DB::table('users')
    	    ->where('id', $request['id'])
    	    ->update(['email' => $request['email']]);
    	
    	if($request['type'] == 'driver'){
    	    DB::table('drivers')
    		->where('user_id', $request['id'])
    		->update(['email' => $request['email']]);
     	}

    	if($request['type'] == 'sponsor'){
                DB::table('sponsors')
                    ->where('user_id', $request['id'])
                    ->update(['email' => $request['email']]);
        }

    	return back();
    }

    public function changeAddress(Request $request)
    {
    	DB::table('address')
    	    ->where('id', $request['id'])
    	    ->update(['street_address' => $request['street_address'],
    	    'zip_code' => $request['zip_code'],
    	    'state' => $request['state'],
    	    'city' => $request['city']]);
       	return back();
    }

    public function changePoints(Request $request)
    {
            DB::table('driver_sponsor')
                ->where('driver_id',$request['id'])
                ->increment('points_balance', $request['points']);
        

        return back();
    }

    public function createAddress(Request $request)
    {

        $address = DB::table('address')->insert(
            ['street_address' => $request['street_address'], 'city' => $request['city'], 'state' => $request['state'], 'zip_code' => $request['zip_code']]
        );

        $new_id = Address::max('id');

        DB::table('drivers')
            ->where('user_id',$request['driver'])
            ->update(['address_id' => $new_id]);

        return back();
    }

    public function changeName(Request $request)
    {
    	DB::table('users')
    	    ->where('id', $request['id'])
    	    ->update(['name'=> $request['name']]);

    	if($request['type'] == 'driver'){
    	    DB::table('drivers')
    		->where('user_id', $request['id'])
    		->update(['username' => $request['name']]);
    	}

    	if($request['type'] == 'sponsor'){
    	    DB::table('sponsors')
    		->where('user_id', $request['id'])
    		->update(['username' => $request['name']]);
    	}

        if($request['type'] == 'admin'){
            DB::table('admins')
            ->where('user_id',$request['id'])
            ->update(['username' => $request['name']]);
        }

    	return back();
    }

    public function changePassword(Request $request){
	
	$validator = Validator::make($request->all(),[
	    'id'=> 'required',
            'password' => 'required|string|min:8|confirmed',
	]);
	
	if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
    }

	DB::table('users')
	    ->where('id', $request['id'])
	    ->update(['password' => Hash::make($request['password'])]);

	return back();
    }
}
