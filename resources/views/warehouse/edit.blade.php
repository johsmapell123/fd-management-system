@extends('layouts.app')

@section('title', 'Edit Gudang')

@section('content')
    <h1>Edit Gudang</h1>
    <form action="{{ route('warehouses.update', $warehouse->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Nama Gudang</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $warehouse->name) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Lokasi</label>
            <input type="text" name="location" class="form-control" value="{{ old('location', $warehouse->location) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Batch</label>
            <select name="batch_id" class="form-control" required>
                @foreach($batches as $batch)
                    <option value="{{ $batch->id }}" {{ old('batch_id', $warehouse->rawMaterialStock->first()->batch_id ?? '') == $batch->id ? 'selected' : '' }}>{{ $batch->batch_code }} ({{ $batch->material_type }})</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Jumlah Stok</label>
            <input type="number" name="quantity" class="form-control" value="{{ old('quantity', $warehouse->rawMaterialStock->first()->available_quantity ?? 0) }}" step="0.01" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Satuan</label>
            <input type="text" name="unit" class="form-control" value="{{ old('unit', $warehouse->rawMaterialStock->first()->unit ?? '') }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('warehouses.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection