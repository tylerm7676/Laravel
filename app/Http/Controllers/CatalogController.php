<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Orchestra\Parser\Xml\Facade as XmlParser;

class CatalogController extends Controller
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
    public function index(Request $request)
    {   
        if (Auth::user()->type === 'driver') {
            $items = [];
            if ($request->sponsor_index) {
                $items = Auth::user()->driver->sponsors[$request->sponsor_index-1]->items;
            } else {
                $items = Auth::user()->driver->sponsors[0]->items;
            }
            return view('catalog', compact('items', $items));
        }
        return view('catalog');
    }

    public function search(Request $request) {
        $query_string = $request->querystr;
        $xml = new \SimpleXMLElement(search_ebay_products($query_string));
        $items = $xml->searchResult->item;
        return view('catalog_results', compact('items', $items));
    }

    public function newItem(Request $request) {
        $item = new \App\Item;
        $item->id = $request->itemIdl;
        $item->sponsor_id = $request->sponsor_id;
        $item->title = $request->title;
        $item->thumbnail_url = $request->thumbnail_url;
        $item->price = $request->currentPrice;
        $item->save();
        return redirect('/catalog');
    }
}
