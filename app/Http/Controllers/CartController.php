<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Cart;
use App\Item;
use Illuminate\Http\Request;

class CartController extends Controller
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
        $items = [];
        $driver_id = Auth::user()->driver->id;
        $carts = Cart::all()->where('driver_id',$driver_id);
        for ($i =0; $i < count($carts); $i++) {
            $item = Item::find($carts[$i]->item_id);
            array_push($items, $item)
        }
        return view('cart', compact('items', $items));
    }

    public function add(Request $request) {
        $cart = new Cart;
        $cart->item_id = $request->item_id;
        $cart->driver_id = $request->driver_id;
        $cart->quantity = $request->quantity;
        $cart->save();
        return redirect()->back();
    }
}
