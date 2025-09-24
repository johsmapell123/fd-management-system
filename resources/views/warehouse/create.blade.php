@extends('layouts.app')

@section('title', 'Tambah Gudang')

@section('content')
    <h1>Tambah Gudang</h1>
    <form action="{{ route('warehouses.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nama Gudang</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Lokasi</label>
            <input type="text" name="location" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Kapasitas</label>
            <input type="number" name="capacity" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Batch Awal</label>
            <select name="batch_id" class="form-control" required>
                @foreach($batches as $batch)
                    <option value="{{ $batch->id }}">{{ $batch->batch_code }} ({{ $batch->material_type }})</option>
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
        <a href="{{ route('warehouses.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection