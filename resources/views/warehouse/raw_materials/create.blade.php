@extends('layouts.app')

@section('title', 'Tambah Batch Bahan Baku')

@section('content')
    <h1>Tambah Batch Bahan Baku</h1>
    @php
        $route = Auth::user()->position === 'Admin' 
            ? 'raw-material-batches.store' : 
            (Auth::user()->position === 'Staff' ? 'staff.raw-material-batches.store' : 'home');
    @endphp
    <form action="{{ route('raw-material-batches.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Kode Batch</label>
            <input type="text" name="batch_code" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Jenis Bahan</label>
            <input type="text" name="material_type" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Tanggal Diterima</label>
            <input type="date" name="received_date" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control" required>
                <option value="Received">Received</option>
                <option value="In Use">In Use</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Gudang</label>
            <select name="warehouse_id" class="form-control" required>
                @foreach($warehouses as $warehouse)
                    <option value="{{ $warehouse->id }}">{{ $warehouse->name }} ({{ $warehouse->location }})</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Jumlah Stok Awal</label>
            <input type="number" name="initial_quantity" class="form-control" step="0.01" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Satuan</label>
            <input type="text" name="unit" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('raw-material-batches.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection