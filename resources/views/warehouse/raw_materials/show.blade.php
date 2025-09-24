@extends('layouts.app')

@section('title', 'Detail Bahan Baku')

@section('content')
<h1>Detail Batch</h1>
<div class="card">
  <div class="card-body">
    <p><strong>Batch Code:</strong> {{ $batch->batch_code }}</p>
    <p><strong>Supplier:</strong> {{ $batch->supplier->name }}</p>
    <p><strong>Tipe Material:</strong> {{ $batch->material_type }}</p>
    <p><strong>Tanggal Diterima:</strong> {{ $batch->received_date }}</p>
    <p><strong>Kuantitas:</strong> {{ $batch->quantity }}</p>
    <p><strong>Satuan Unit:</strong> {{ $batch->unit }}</p>
    <p><strong>Status:</strong> {{ $batch->status }}</p>
    <p><strong>Catatan:</strong> {{ $batch->notes }}</p>
  </div>
</div>
<a href="{{ route('raw-material-batches.index') }}" class="btn btn-secondary mt-3">Kembali</a>
@endsection