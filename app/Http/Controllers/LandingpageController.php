<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class LandingpageController extends Controller
{
    public function index()
    {
        return view('pages.landingpage.index', []);
    }

    public function product(Request $request)
    {
        // check query params category
        if ($request->query('category')) {
            $items = Item::where('category', $request->query('category'))->get();
        } else {
            $items = Item::all();
        }

        $list_category = ['Sparepart Standar', 'Sparepart Racing', 'Oli', 'Apparel', 'Accessories', 'Other'];

        return view('pages.landingpage.product', [
            'items' => $items,
            'list_category' => $list_category,
        ]);
    }

    public function productDetail($id)
    {
        $item = Item::find($id);

        return view('pages.landingpage.product-detail', [
            'item' => $item,
        ]);
    }
}
