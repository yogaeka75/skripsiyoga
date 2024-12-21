<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use App\Models\Item;
use App\Models\ItemHistory;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = PurchaseOrder::all();

        return view('pages.purchase-order.index', [
            'items' => $items,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $result = PurchaseOrder::create($data);

        return redirect()->route('purchase-order.show', $result->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $list_items = Item::all();

        $purchaseOrder = PurchaseOrder::find($id);
        $items = PurchaseOrderItem::where('purchase_order_id', $id)->get();

        return view('pages.purchase-order.item.index', [
            'list_items' => $list_items,

            'purchaseOrder' => $purchaseOrder,
            'items' => $items,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $purchaseOrder = PurchaseOrder::find($id);
        $purchaseOrder->update($request->all());

        if ($request->status == 'DONE') {
            $purchaseOrderItems = PurchaseOrderItem::where('purchase_order_id', $id)->get();
            foreach ($purchaseOrderItems as $i) {
                $item = Item::find($i->item_id);

                ItemHistory::create([
                    'item_id' => $i->item_id,
                    'quantity_before' => $item->stock,
                    'quantity' => $i->quantity,
                    'quantity_after' => $item->stock + $i->quantity,
                    'description' => 'Added from Purchase Order #00' . $id,
                    'type' => 'PURCHASE ORDER',
                ]);

                $item->stock += $i->quantity;
                $item->save();
            }
        }

        return redirect()
            ->route('purchase-order.show', $purchaseOrder->id)
            ->with('success', 'Successfully updated purchase order.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $purchaseOrder = PurchaseOrder::find($id);
        $purchaseOrder->delete();

        return redirect()->route('purchase-order.index')->with('success', 'Successfully deleted purchase order.');
    }
}
