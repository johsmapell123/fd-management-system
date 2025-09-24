@extends('layouts.app')

@section('title', 'Detail supplier')

@section('content')
<h1>Detail supplier: {{ $supplier->name }}</h1>
<div class="card">
  <div class="card-body">
    <p><strong>Contact Person:</strong> {{ $supplier->contact_person }}</p>
    <p><strong>Departemen:</strong> {{ $supplier->phone }}</p>
    <p><strong>Posisi:</strong> {{ $supplier->email }}</p>
    <p><strong>Dibuat:</strong> {{ $supplier->address }}</p>
  </div>
</div>
<a href="{{ route('suppliers.index') }}" class="btn btn-secondary mt-3">Kembali</a>
@endsection