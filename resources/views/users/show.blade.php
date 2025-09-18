@extends('layouts.app')

@section('title', 'Detail User')

@section('content')
<h1>Detail User: {{ $user->name }}</h1>
<div class="card">
  <div class="card-body">
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Departemen:</strong> {{ $user->department }}</p>
    <p><strong>Posisi:</strong> {{ $user->position }}</p>
    <p><strong>Dibuat:</strong> {{ $user->created_at }}</p>
  </div>
</div>
<a href="{{ route('users.index') }}" class="btn btn-secondary mt-3">Kembali</a>
@endsection