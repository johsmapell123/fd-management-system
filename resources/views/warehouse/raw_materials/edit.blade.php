@extends('layouts.app')

@section('title', 'Edit Batch Bahan Baku')

@section('content')
    <h1>Edit Batch Bahan Baku</h1>
    @php
        $route = Auth::user()->position === 'Admin' 
            ? 'raw-material-batches.update' : 
            (Auth::user()->position === 'Manager' ? 'manager.raw-material-batches.update' : 'home');
    @endphp
    <form action="{{ route($route, $batch->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Kode Batch</label>
            <input type="text" name="batch_code" class="form-control" value="{{ old('batch_code', $batch->batch_code) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Jenis Bahan</label>
            <input type="text" name="material_type" class="form-control" value="{{ old('material_type', $batch->material_type) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Tanggal Diterima</label>
            <input type="date" name="received_date" class="form-control" value="{{ old('received_date', $batch->received_date) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control" required>
                <option value="Received" {{ old('status', $batch->status) == 'Received' ? 'selected' : '' }}>Received</option>
                <option value="In Use" {{ old('status', $batch->status) == 'In Use' ? 'selected' : '' }}>In Use</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Gudang</label>
            <select name="warehouse_id" class="form-control" required>
                @foreach($warehouses as $warehouse)
                    <option value="{{ $warehouse->id }}" {{ old('warehouse_id', $batch->rawMaterialStock->first()->warehouse_id ?? '') == $warehouse->id ? 'selected' : '' }}>{{ $warehouse->name }} ({{ $warehouse->location }})</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Jumlah Stok</label>
            <input type="number" name="quantity" class="form-control" value="{{ old('quantity', $batch->rawMaterialStock->first()->quantity ?? 0) }}" step="0.01" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Satuan</label>
            <input type="text" name="unit" class="form-control" value="{{ old('unit', $batch->rawMaterialStock->first()->unit ?? '') }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('raw-material-batches.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection