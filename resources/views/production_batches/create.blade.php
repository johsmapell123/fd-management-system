@extends('layouts.app')

@section('title', 'Mulai Produksi')

@section('content')
    <h1>Mulai Produksi</h1>
    <form action="{{ route('production-batches.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="production_date" class="form-label">Tanggal Produksi</label>
            <input type="date" class="form-control" id="production_date" name="production_date">
        </div>
        <div class="mb-3">
            <label for="shift" class="form-label">Shift</label>
            <select class="form-select" id="shift" name="shift">
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="quantity_carton" class="form-label">Jumlah Karton</label>
            <input type="number" class="form-control" id="quantity_carton" name="quantity_carton">
        </div>
        <div class="mb-3">
            <label for="notes" class="form-label">Catatan</label>
            <textarea class="form-control" id="notes" name="notes"></textarea>
        </div>
        <!-- Tambah bahan (contoh sederhana, bisa pakai JS untuk add row dynamic jika perlu) -->
        <h3>Tambah Bahan</h3>
        <div class="mb-3">
            <label for="materials[0][raw_batch_id]" class="form-label">Batch Bahan</label>
            <select class="form-select" name="materials[0][raw_batch_id]">
                @foreach($rawBatches as $rawBatch)
                    <option value="{{ $rawBatch->batch_id }}">{{ $rawBatch->batch_code }} ({{ $rawBatch->material_type }})</option>
                @endforeach
            </select>
            <input type="hidden" name="materials[0][material_type]" value="Flour"> <!-- Adaptasi -->
            <label for="materials[0][quantity_used]" class="form-label">Jumlah Digunakan</label>
            <input type="number" step="0.01" class="form-control" name="materials[0][quantity_used]">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection