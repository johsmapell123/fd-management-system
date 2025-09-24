@extends('layouts.app')

@section('title', 'Detail Bahan Baku')

@section('content')
<h1>Detail Gudang {{ $warehouse->name }}</h1>
<div class="card">
  <div class="card-body">
    <p><strong>Nama:</strong> {{ $warehouse->name  }}</p>
    <p><strong>Tipe:</strong> {{ $warehouse->type }}</p>
    <p><strong>Lokasi:</strong> {{ $warehouse->location }}</p>
    <p>
        <strong>Batch Terkait:</strong> <br>
        @foreach($warehouse->rawMaterialStock as $index => $stock)
            {{ $index+1 }}. {{ $stock->rawMaterialBatch->batch_code }} ({{ $stock->available_quantity }} {{ $stock->unit }})<br>
        @endforeach
    </p>
  </div>
</div>
<a href="{{ route('raw-material-batches.index') }}" class="btn btn-secondary mt-3">Kembali</a>
@endsection