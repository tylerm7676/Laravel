<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Driver;
use App\Sponsor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'type'=> ['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'type' => $data['type'],
        ]);

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

      return $user;

    }
}
