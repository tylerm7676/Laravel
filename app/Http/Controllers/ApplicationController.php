<?php

namespace App\Http\Controllers;

use App\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApplicationController extends Controller
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
     * 
     */
    public function newApplication(Request $request) 
    {
        $validator =  Validator::make($request->all(), [
            'sponsor' => 'required',
            'explanation' => 'required|max:255',
        ]);
        
        if ($validator->fails()){
            return redirect('/profile')
                    ->withErrors($validator)
                    ->withInput();
        }

        $application = new Application;
        $application->sponsor_id = $request->sponsor;
        $application->driver_id = $request->driver;
        $application->filename = $request->explanation;
        $application->status = 'open';
        $application->save();
        return redirect('/profile');
        
    }

    public function acceptDriver(Request $request) {
        $application = Application::where('driver_id', $request->driver_id)->where('sponsor_id', $request->sponsor_id)->first();
        $application->status = 'accepted';
        $application->save();

        $sponsor = \App\Sponsor::find($request->sponsor_id);
        $driver = \App\Driver::find($request->driver_id);
        $sponsor->drivers()->attach($driver, ['points_balance' => 0]);
        $sponsor->save();
        return redirect('/driverlist');
    }
}
