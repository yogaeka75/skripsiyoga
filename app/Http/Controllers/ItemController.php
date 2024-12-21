<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Item;
use App\Models\ItemHistory;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list_pcs = ['pcs', 'box', 'pack', 'set', 'dozen', 'meter', 'liter', 'gram', 'kilogram', 'ton', 'other'];
        $list_category = ['Sparepart Standar', 'Sparepart Racing', 'Oli', 'Apparel', 'Accessories', 'Other'];

        $items = Item::all();

        return view('pages.item.index', [
            'list_pcs' => $list_pcs,
            'list_category' => $list_category,

            'items' => $items,
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function show($id)
    {
        $item = Item::find($id);
        $histories = ItemHistory::where('item_id', $id)->orderBy('created_at', 'desc')->get();

        return view('pages.item.show', [
            'item' => $item,
            'histories' => $histories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['stock'] = 0;

        $file = $request->file('thumbnail')->store('images', 'public');
        $data['thumbnail'] = 'storage/' . $file;

        Item::create($data);

        return redirect()->route('item.index')->with('success', 'Successfully added item');
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $item = Item::find($id);

        //   change using storage
        if ($request->file('thumbnail')) {
            $file = $request->file('thumbnail')->store('images', 'public');
            $data['thumbnail'] = 'storage/' . $file;
        }

        // Update the item with the new data
        $item->update($data);

        // Redirect back to the item index page with a success message
        return redirect()->route('item.index')->with('success', 'Successfully updated item');
    }
}
