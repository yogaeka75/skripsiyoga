<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SalesOrder;
use App\Models\SalesOrderItem;
use App\Models\Item;
use App\Models\ItemHistory;

class SalesOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = SalesOrder::all();

        return view('pages.sales-order.index', [
            'items' => $items,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $result = SalesOrder::create($data);

        return redirect()->route('sales-order.show', $result->id);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $list_items = Item::all();

        $salesOrder = SalesOrder::find($id);
        $items = SalesOrderItem::where('sales_order_id', $id)->get();

        return view('pages.sales-order.item.index', [
            'list_items' => $list_items,

            'salesOrder' => $salesOrder,
            'items' => $items,
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $salesOrder = SalesOrder::find($id);

        if ($request->status == 'DONE') {
            $salesOrderItems = SalesOrderItem::where('sales_order_id', $id)->get();
            foreach ($salesOrderItems as $i) {
                $item = Item::find($i->item_id);

                if ($item->stock < $i->quantity) {
                    return redirect()
                        ->route('sales-order.show', $salesOrder->id)
                        ->with('error', 'Stock is not enough.');
                }

                ItemHistory::create([
                    'item_id' => $i->item_id,
                    'quantity_before' => $item->stock,
                    'quantity' => $i->quantity,
                    'quantity_after' => $item->stock - $i->quantity,
                    'description' => 'Remove from Sales Order #00' . $id,
                    'type' => 'SALES ORDER',
                ]);

                $item->stock -= $i->quantity;
                $item->save();
            }
        }

        $salesOrder->update($request->all());

        return redirect()
            ->route('sales-order.show', $salesOrder->id)
            ->with('success', 'Successfully updated sales order.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SalesOrder $salesOrder)
    {
        //
    }
}
