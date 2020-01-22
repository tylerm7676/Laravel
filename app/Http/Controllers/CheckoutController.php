<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Cart;   
use App\Item;
use Illuminate\Http\Request;

class CheckoutController extends Controller
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
        $total = 0;
        $driver_id = Auth::user()->driver->id;
        $carts = Cart::all()->where('driver_id',$driver_id);
        for ($i =0; $i < count($carts); $i++) {
            $item = Item::find($carts[$i]->item_id);
            $total += $item->price;
        }
        return view('checkout', compact('total', $total));
    }
}
