@extends('layouts.app')

@section('title', 'Edit Supplier')

@section('content')
<h1>Edit Supplier</h1>
@php
  $route = '';
  if (Auth::user()->position === 'Manager') {
    $route = 'manager.suppliers.update';
  } elseif (Auth::user()->position === 'Admin') {
    $route = 'suppliers.update';
  }
@endphp

<form action="{{ route($route, $supplier) }}" method="POST">
  @csrf @method('PUT')
  <div class="mb-3">
    <label for="name" class="form-label">Nama</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ $supplier->name }}" required>
  </div>
  <div class="mb-3">
    <label for="contact_person" class="form-label">contact_person</label>
    <input type="text" class="form-control" id="contact_person" name="contact_person" value="{{ $supplier->contact_person }}" required>
  </div>
  <div class="mb-3">
    <label for="phone" class="form-label">Phone</label>
    <input type="text" class="form-control" id="phone" name="phone" value="{{ $supplier->phone }}" required>
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" id="email" name="email" value="{{ $supplier->email }}" required>
  </div>
  <div class="mb-3">
    <label for="address" class="form-label">Address</label>
    <input type="text" class="form-control" id="address" name="address" value="{{ $supplier->address }}" required>
  </div>
  {{-- <div class="mb-3">
    <label for="password" class="form-label">Password (kosongkan jika tidak ubah)</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>
  <div class="mb-3">
    <label for="department" class="form-label">Departemen</label>
  </div>
  <div class="mb-3">
    <label for="position" class="form-label">Posisi</label>
    <select class="form-select" id="position" name="position" required>
      <option value="Staff" {{ $supplier->position === 'Staff' ? 'selected' : '' }}>Staff</option>
      <option value="Manager" {{ $supplier->position === 'Manager' ? 'selected' : '' }}>Manager</option>
      <option value="Admin" {{ $supplier->position === 'Admin' ? 'selected' : '' }}>Admin</option>
    </select>
  </div> --}}
  <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection