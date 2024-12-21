<!-- Modal -->
<div class="modal fade" id="formCreate" tabindex="-1" role="dialog" aria-labelledby="formCreateLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('sales-order-item.store') }}" method="POST">
                @csrf
                <input type="hidden" name="sales_order_id" value="{{ $salesOrder->id }}">

                <div class="modal-header">
                    <h5 class="modal-title" id="formCreateLabel">
                        Add Item
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="salesOrder">Sales Order</label>
                        <input type="text" class="form-control" id="salesOrder" disabled
                            value="Sales Order #00{{ $salesOrder->id }}" />
                    </div>
                    <div class="form-group">
                        <label for="item_id">Item</label>
                        <select name="item_id" id="item_id" class="form-control" required>
                            <option value="">-- Select Item --</option>
                            @foreach ($list_items as $i)
                                <option value="{{ $i->id }}">
                                    {{ $i->name }} - {{ $i->price }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" class="form-control" id="quantity" placeholder="Input Quantity"
                            name="quantity" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
