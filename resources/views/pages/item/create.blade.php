<!-- Modal -->
<div class="modal fade" id="formCreate" tabindex="-1" role="dialog" aria-labelledby="formCreateLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('item.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="formCreateLabel">
                        Create Item
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
                                <input type="file" class="form-control-file" id="thumbnail" name="thumbnail"
                                required />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name">Code</label>
                                <input type="text" class="form-control" id="code" placeholder="Input Code"
                                    name="code" required />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Input Name"
                                    name="name" required />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="category">Ketegori</label>
                                <select name="category" id="category" class="form-control" required>
                                    <option value="">-- Kategori --</option>
                                    @foreach ($list_category as $i)
                                        <option value="{{ $i }}">
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
                                    placeholder="Input Stock Alert" name="stock_alert" required />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="pcs">Pcs</label>
                                <select name="pcs" id="pcs" class="form-control" required>
                                    <option value="">-- Pcs Akses --</option>
                                    @foreach ($list_pcs as $i)
                                        <option value="{{ $i }}">
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
                                    name="price" required />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="price_sell">Price Sell</label>
                                <input type="number" class="form-control" id="price_sell"
                                    placeholder="Input Price Sell" name="price_sell" required />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea type="text" class="form-control" id="description" placeholder="Input description" name="description"
                                    rows="3"></textarea>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
