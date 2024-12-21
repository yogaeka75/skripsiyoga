<!-- Modal -->
<div class="modal fade" id="formUpdate{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="formUpdate{{ $item->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('item.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="formUpdate{{ $item->id }}Label">
                        Update Item
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="thumbnail">Thumbnail</label>
                                <input type="file" class="form-control-file" id="thumbnail" name="thumbnail" />

                                <span class="text-muted mt-5 text-sm">
                                    Upload if you want to change the thumbnail
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name">Code</label>
                                <input type="text" class="form-control" id="code" placeholder="Input Code"
                                    name="code" required value="{{ $item->code }}" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Input Name"
                                    name="name" required value="{{ $item->name }}" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="category">Ketegori</label>
                                <select name="category" id="category" class="form-control" required>
                                    <option value="">-- Kategori --</option>
                                    @foreach ($list_category as $i)
                                        <option value="{{ $i }}"
                                            {{ $i == $item->category ? 'selected' : '' }}>
                                            {{ $i }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="stock_alert">Stock Alert</label>
                                <input type="text" class="form-control" id="stock_alert"
                                    placeholder="Input Stock Alert" name="stock_alert" required
                                    value="{{ $item->stock_alert }}" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="pcs">Pcs</label>
                                <select name="pcs" id="pcs" class="form-control" required>
                                    <option value="">-- Pcs Akses --</option>
                                    @foreach ($list_pcs as $i)
                                        <option value="{{ $i }}" {{ $i == $item->pcs ? 'selected' : '' }}>
                                            {{ $i }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" class="form-control" id="price" placeholder="Input Price"
                                    name="price" required value="{{ $item->price }}" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="price_sell">Price Sell</label>
                                <input type="number" class="form-control" id="price_sell"
                                    placeholder="Input Price Sell" name="price_sell" required
                                    value="{{ $item->price_sell }}" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea type="text" class="form-control" id="description" placeholder="Input description" name="description"
                                    rows="3">{{ $item->description }}</textarea>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
