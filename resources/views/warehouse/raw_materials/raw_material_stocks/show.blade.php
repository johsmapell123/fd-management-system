@extends('layouts.app')

@section('title', 'Detail Bahan Baku')

@section('content')
<h1>Detail Stok Bahan Baku</h1>
<div class="card">
  <div class="card-body">
    <p><strong>Batch Code:</strong> {{ $rawMaterialStock->rawMaterialBatch->batch_code }}</p>
    <p><strong>Jumlah Tersedia:</strong> {{ intval($rawMaterialStock->available_quantity) }}</p>
    <p><strong>Satuan Unit:</strong> {{ $rawMaterialStock->unit }}</p>
    <p><strong>Gudang:</strong> {{ $rawMaterialStock->warehouse->name }}</p>
  </div>
</div>
<a href="{{ route('raw-material-batches.index') }}" class="btn btn-secondary mt-3">Kembali</a>
@endsection