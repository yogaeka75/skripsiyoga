@extends('layouts.app') @section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-md-6">
                    <h1 class="mb-2">
                        Purchase Order #00{{ $purchaseOrder->id }}
                    </h1>

                    <table>
                        <tr>
                            <td>Status</td>
                            <td class="px-2">:</td>
                            <td>@include('includes.badge', ['status' => $purchaseOrder->status])</td>
                        </tr>
                        <tr>
                            <td>Date</td>
                            <td class="px-2">:</td>
                            <td>{{ $purchaseOrder->date }}</td>
                        </tr>
                        <tr>
                            <td>Supplier</td>
                            <td class="px-2">:</td>
                            <td>{{ $purchaseOrder->supplier }}</td>
                        </tr>
                        <tr>
                            <td>Total Amount</td>
                            <td class="px-2">:</td>
                            <td class="rupiah-format">{{ $purchaseOrder->total_amount }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <div class="d-flex justify-content-end" style="gap: 0.5rem">
                        @if ($purchaseOrder->status !== 'DONE')
                            <form action="{{ route('purchase-order.update', $purchaseOrder->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="REJECTED">

                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-times mr-2"></i> Reject
                                </button>
                            </form>
                        @endif
                        @if ($purchaseOrder->status == 'DRAFT')
                            <form action="{{ route('purchase-order.update', $purchaseOrder->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="WAITING_VALIDATION">

                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-check mr-2"></i> Validate
                                </button>
                            </form>
                        @endif
                        @if ($purchaseOrder->status == 'WAITING_VALIDATION')
                            <form action="{{ route('purchase-order.update', $purchaseOrder->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="DONE">

                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-check mr-2"></i> Approve
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @include('includes.error-card')
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @if ($purchaseOrder->status == 'DRAFT')
                                <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#formCreate"><i
                                        class="fa fa-plus"></i> Add Item</a>
                                @include('pages.purchase-order.item.create')
                            @endif
                            <table id="defaultTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Quantity</th>
                                        <th class="text-right">Total</th>
                                        @if ($purchaseOrder->status == 'DRAFT')
                                            <th>Aksi</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach ($items as $item)
                                        <tr>
                                            <td>
                                                {{ $i }}
                                            </td>
                                            <td>{{ $item->item->name }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td class="rupiah-format text-right">{{ $item->total }}</td>
                                            @if ($purchaseOrder->status == 'DRAFT')
                                                <td>
                                                    <a type="button" class="btn btn-warning" data-toggle="modal"
                                                        data-target="#formUpdate{{ $item->id }}">
                                                        <i class="fa fa-edit" title="Ubah Data User"></i>
                                                    </a>

                                                    <form id="formDelete{{ $item->id }}"
                                                        action="{{ route('purchase-order-item.destroy', $item->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('delete')
                                                        <a type="button" class="btn btn-danger"
                                                            onclick="handleDelete({{ $item->id }})">
                                                            <i class="fa fa-trash"
                                                                title="Hapus Data Purchase Order Item"></i>
                                                        </a>
                                                    </form>

                                                    <script>
                                                        function handleDelete(id) {
                                                            Swal.fire({
                                                                title: 'Apakah kamu yakin?',
                                                                text: "kamu akan menghapus data ini!",
                                                                icon: 'warning',
                                                                showCancelButton: true,
                                                                confirmButtonColor: '#3085d6',
                                                                cancelButtonColor: '#d33',
                                                                confirmButtonText: 'Ya, hapus!'
                                                            }).then((result) => {
                                                                if (result.isConfirmed) {
                                                                    document.getElementById('formDelete' + id).submit();
                                                                }
                                                            })
                                                        }
                                                    </script>
                                                </td>
                                            @endif
                                        </tr>
                                        @include('pages.purchase-order.item.update')
                                        <?php $i++; ?>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
