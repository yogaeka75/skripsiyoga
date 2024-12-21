<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use App\Models\Item;

class PurchaseOrderItemController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $price = Item::find($request->item_id)->price;

        $data = $request->all();
        $data['total'] = $price * $request->quantity;

        PurchaseOrderItem::create($data);

        // update total amount in purchase order
        $purchaseOrderItems = PurchaseOrderItem::where('purchase_order_id', $request->purchase_order_id)->get();
        $totalAmount = 0;
        foreach ($purchaseOrderItems as $item) {
            $totalAmount += $item->total;
        }

        $purchaseOrder = PurchaseOrder::find($request->purchase_order_id);
        $purchaseOrder->total_amount = $totalAmount;
        $purchaseOrder->save();

        return redirect()
            ->route('purchase-order.show', $request->purchase_order_id)
            ->with('success', 'Item added to purchase order');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $purchaseOrderItem = PurchaseOrderItem::find($id);
        $purchaseOrderItem->quantity = $request->quantity;
        $purchaseOrderItem->total = $purchaseOrderItem->item->price * $request->quantity;
        $purchaseOrderItem->save();

        // update total amount in purchase order
        $purchaseOrderItems = PurchaseOrderItem::where('purchase_order_id', $purchaseOrderItem->purchase_order_id)->get();
        $totalAmount = 0;
        foreach ($purchaseOrderItems as $item) {
            $totalAmount += $item->total;
        }

        $purchaseOrder = PurchaseOrder::find($purchaseOrderItem->purchase_order_id);
        $purchaseOrder->total_amount = $totalAmount;
        $purchaseOrder->save();

        return redirect()
            ->route('purchase-order.show', $purchaseOrderItem->purchase_order_id)
            ->with('success', 'Item updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $purchaseOrderItem = PurchaseOrderItem::find($id);
        $purchaseOrderItem->delete();

        // update total amount in purchase order
        $purchaseOrderItems = PurchaseOrderItem::where('purchase_order_id', $purchaseOrderItem->purchase_order_id)->get();
        $totalAmount = 0;
        foreach ($purchaseOrderItems as $item) {
            $totalAmount += $item->total;
        }

        $purchaseOrder = PurchaseOrder::find($purchaseOrderItem->purchase_order_id);
        $purchaseOrder->total_amount = $totalAmount;
        $purchaseOrder->save();

        return redirect()
            ->route('purchase-order.show', $purchaseOrderItem->purchase_order_id)
            ->with('success', 'Item removed from purchase order');
    }
}
