<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Sponsor extends Controller
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

    public function changeOrgname(Request $request) {
        $sponsor = \App\Sponsor::find($request->sponsor );
        $sponsor->organization = $request->name;
        $sponsor->save();
        return back();
    }
    public function changeConversion(Request $request) {
        $sponsor = \App\Sponsor::find($request['sponsor_id']);
        $sponsor->conversion = $request['conversion'];
        $sponsor->save();
        return back();
    }
    public function changeInfo(Request $request) {
        $sponsor = \App\Sponsor::find($request['sponsor_id']);
        $sponsor->info = $request['info'];
        $sponsor->save();
        return back();
    }
}
