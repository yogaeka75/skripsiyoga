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

        // $file = $request->file('thumbnail')->store('images', 'public');
        // $data['thumbnail'] = 'storage/' . $file;

        $file = $request->file('thumbnail');
        $file_name = time() . '_' . $file->extension();
        $file->move('images', $file_name);
        $data['thumbnail'] = 'images/' . $file_name;

        Item::create($data);

        return redirect()->route('item.index')->with('success', 'Successfully added item');
    }

   public function update(Request $request, $id)
   {
       $data = $request->all();
       $item = Item::find($id);

       // Periksa jika ada file thumbnail yang diunggah
       if ($request->file('thumbnail')) {
           // Hapus file lama jika ada
           if ($item->thumbnail && file_exists(public_path($item->thumbnail))) {
               unlink(public_path($item->thumbnail));
           }

           // Simpan file baru ke direktori yang sama seperti `store`
           $file = $request->file('thumbnail');
           $file_name = time() . '_' . $file->getClientOriginalName();
           $file->move('images', $file_name);
           $data['thumbnail'] = 'images/' . $file_name;
       }

       // Update item dengan data baru
       $item->update($data);

       // Redirect ke halaman index dengan pesan sukses
       return redirect()->route('item.index')->with('success', 'Successfully updated item');
   }

    public function destroy($id)
        {
    $item = Item::findOrFail($id);

    // Hapus file thumbnail jika ada
    if ($item->thumbnail && file_exists(public_path($item->thumbnail))) {
        unlink(public_path($item->thumbnail));
    }

    // Hapus data barang
    $item->delete();

    return redirect()->route('item.index')->with('success', 'Successfully deleted item');
}


}