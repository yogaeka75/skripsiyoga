@extends('layouts.app') @section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-md-6">
                    <h1 class="mb-2">
                        Sales Order #00{{ $salesOrder->id }}
                    </h1>

                    <table>
                        <tr>
                            <td>Status</td>
                            <td class="px-2">:</td>
                            <td>@include('includes.badge', ['status' => $salesOrder->status])</td>
                        </tr>
                        <tr>
                            <td>Date</td>
                            <td class="px-2">:</td>
                            <td>{{ $salesOrder->date }}</td>
                        </tr>
                        <tr>
                            <td>Customer</td>
                            <td class="px-2">:</td>
                            <td>{{ $salesOrder->customer }}</td>
                        </tr>
                        <tr>
                            <td>Total Amount</td>
                            <td class="px-2">:</td>
                            <td class="rupiah-format">{{ $salesOrder->total_amount }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <div class="d-flex justify-content-end" style="gap: 0.5rem">
                        @if ($salesOrder->status !== 'DONE')
                            <form action="{{ route('sales-order.update', $salesOrder->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="REJECTED">

                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-times mr-2"></i> Reject
                                </button>
                            </form>
                        @endif
                        @if ($salesOrder->status == 'DRAFT')
                            <form action="{{ route('sales-order.update', $salesOrder->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="WAITING_VALIDATION">

                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-check mr-2"></i> Validate
                                </button>
                            </form>
                        @endif
                        @if ($salesOrder->status == 'WAITING_VALIDATION')
                            <form action="{{ route('sales-order.update', $salesOrder->id) }}" method="POST">
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
                            @if ($salesOrder->status == 'DRAFT')
                                <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#formCreate"><i
                                        class="fa fa-plus"></i> Add Item</a>
                                @include('pages.sales-order.item.create')
                            @endif
                            <table id="defaultTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Quantity</th>
                                        <th class="text-right">Total</th>
                                        @if ($salesOrder->status == 'DRAFT')
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
                                            @if ($salesOrder->status == 'DRAFT')
                                                <td>
                                                    <a type="button" class="btn btn-warning" data-toggle="modal"
                                                        data-target="#formUpdate{{ $item->id }}">
                                                        <i class="fa fa-edit" title="Ubah Data User"></i>
                                                    </a>

                                                    <form id="formDelete{{ $item->id }}"
                                                        action="{{ route('sales-order-item.destroy', $item->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('delete')
                                                        <a type="button" class="btn btn-danger"
                                                            onclick="handleDelete({{ $item->id }})">
                                                            <i class="fa fa-trash" title="Hapus Data Sales Order Item"></i>
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
                                        @include('pages.sales-order.item.update')
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
