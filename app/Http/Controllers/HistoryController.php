<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ItemHistory;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
           $items = ItemHistory::join('items', 'item_histories.item_id', '=', 'items.id')
                 ->select('item_histories.*', 'items.name')
                 ->orderBy('item_histories.created_at', 'desc')
                 ->get();

        return view('pages.history.index', [
            'items' => $items,
        ]);
    }
}