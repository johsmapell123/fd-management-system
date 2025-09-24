@extends('layouts.app')

@section('title', 'Dashboard Manager')

@section('content')
    <h1>Dashboard Manager</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Stok Bahan Baku Real-Time</div>
                <div class="card-body">
                    <table class="table">
                        @foreach($stocks as $stock)
                            <tr><td>{{ $stock->material_type }}</td><td>{{ $stock->total_quantity }} {{ $stock->unit }}</td></tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Status Produksi Saat Ini</div>
                <div class="card-body">
                    <ul>
                        @foreach($productions as $prod)
                            <li>{{ $prod->production_code }}: {{ $prod->status }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Analisis Efisiensi & Masalah</div>
                <div class="card-body">
                    <p>Jumlah Cacat: {{ $defectiveBatches }}</p>
                    <p>Bagian Lambat: {{ $slowProcesses }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4">
        <h2>Pelacakan Batch</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Kode Batch</th>
                    <th>Jenis Bahan</th>
                    <th>Tanggal Diterima</th>
                    <th>Tanggal Produksi</th>
                    <th>Tanggal Masuk Gudang</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($batchTracking as $batch)
                    <tr>
                        <td>{{ $batch->batch_code }}</td>
                        <td>{{ $batch->material_type }}</td>
                        <td>{{ $batch->received_date ?? '-' }}</td>
                        <td>{{ $batch->production_date ?? '-' }}</td>
                        <td>{{ $batch->warehouse_date ?? '-' }}</td>
                        <td>{{ $batch->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection