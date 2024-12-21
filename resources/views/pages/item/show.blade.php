@extends('layouts.app') @section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> Item #00{{ $item->id }} | {{ $item->name }}</h1>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @include('includes.error-card')
                <div class="col-12">

                    <div class="card">
                        <div class="card-body">
                            <h1>
                                {{ $item->stock }}
                            </h1>

                            <p class="mb-0">
                                <span>Pcs</span>
                                <span class="px-2">:</span>
                                <span>{{ $item->pcs }}</span>
                            </p>
                            <p class="mb-0">
                                <span>Price</span>
                                <span class="px-2">:</span>
                                <span class="rupiah-format">{{ $item->price }}</span>
                            </p>
                            <p class="mb-0">
                                <span>Price Sell</span>
                                <span class="px-2">:</span>
                                <span class="rupiah-format">{{ $item->price_sell }}</span>
                            </p>
                            <p class="mb-0">
                                <span>Stock Alert</span>
                                <span class="px-2">:</span>
                                <span>{{ $item->stock_alert }}</span>
                            </p>
                            <p class="mb-0">
                                <span>Description</span>
                                <span class="px-2">:</span>
                                <span>{{ $item->description }}</span>
                            </p>
                            <br>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Date</th>
                                        <th>Type</th>
                                        <th>Quantity Before</th>
                                        <th>Quantity</th>
                                        <th>Quantity After</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach ($histories as $item)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>{{ $item->type }}</td>
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
