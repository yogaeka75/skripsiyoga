@extends('layouts.app') @section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Selamat Datang {{ request()->session()->get('user')['name'] }} </h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content font-poppins">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-12">
                    <div class="mb-4">
                        <p class="text-muted mb-0">Pendapatan</p>
                        <h2 class="rupiah-format mb-1" style="font-weight: 600">{{ $totalProfit }}</h1>
                            <p class="mb-0" style="font-weight: 600">
                                <span class="text-danger">PO - <span
                                        class="rupiah-format">{{ $totalAmountPurchaseOrder }}</span></span>,
                                <span class="text-success">SO + <span
                                        class="rupiah-format">{{ $totalAmountSalesOrder }}</span></span>
                            </p>

                    </div>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $totalPurchaseOrder }}</h3>

                                    <p class="mb-0">Purchase Order</p>

                                    <p class="">
                                        {{-- There's <b>{{ $totalPurchaseOrderNotDone }}</b> finished purchase order --}}
                                        Total <b>{{ $totalPurchaseOrderNotDone }}</b> PO yang belum selesai
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{ $totalSalesOrder }}</h3>

                                    <p class="mb-0">Sales Order</p>

                                    <p class="">
                                        {{-- There's <b>{{ $totalSalesOrderNotDone }}</b> finished purchase order --}}
                                        Total <b>{{ $totalSalesOrderNotDone }}</b> SO yang belum selesai

                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="info-box bg-warning">
                                <span class="info-box-icon"><i class="fas fa-box"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text mb-0">Goods</span>
                                    <span class="info-box-number" style="font-size: 1.9rem; line-height: 1.9rem">
                                        {{ $totalItem }}
                                        {{-- {{ $totalStock }} --}}
                                    </span>

                                    {{-- <div class="progress">
                                            <div class="progress-bar" style="width: 70%"></div>
                                        </div> --}}
                                    <span class="progress-description">
                                        {{-- There are <b>{{ $totalStock }}</b> goods in the warehouse <br> --}}
                                        {{-- Total <b>{{ $totalStock }}</b> stock barang di gudang <br> --}}
                                        {{-- There are <b>{{ $totalLowStock }}</b> goods that are running low in the
                                        warehouse --}}
                                        Ada <b>{{ $totalLowStock }}</b> barang yang hampir habis di gudang
                                    </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-success">
                        <div class="card-header">
                            History
                        </div>
                        <div class="card-body">
                            <table id="defaultTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Date</th>
                                        <th>Type</th>
                                        <th>Product Name</th>
                                        <th>Quantity Sebelum</th>
                                        <th>Quantity</th>
                                        <th>Quantity Sesudah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach ($items as $item)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>{{ $item->type }}</td>
                                            <td>{{ $item->item->name ?? '-' }}</td>
                                            <td>{{ $item->quantity_before }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ $item->quantity_after }}</td>
                                        </tr>
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