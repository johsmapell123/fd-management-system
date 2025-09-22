@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<h1>Edit User</h1>
<form action="{{ route('users.update', $user) }}" method="POST">
  @csrf @method('PUT')
  <div class="mb-3">
    <label for="name" class="form-label">Nama</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password (kosongkan jika tidak ubah)</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>
  <div class="mb-3">
    <label for="department" class="form-label">Departemen</label>
    <select class="form-select" id="department" name="department" required>
      <option value="Production" {{ $user->department === 'Production' ? 'selected' : '' }}>Production</option>
      <option value="QC" {{ $user->department === 'QC' ? 'selected' : '' }}>QC</option>
      <option value="Warehouse" {{ $user->department === 'Warehouse' ? 'selected' : '' }}>Warehouse</option>
      <option value="Admin" {{ $user->department === 'Admin' ? 'selected' : '' }}>Admin</option>
    </select>
  </div>
  <div class="mb-3">
    <label for="position" class="form-label">Posisi</label>
    <select class="form-select" id="position" name="position" required>
      <option value="Staff" {{ $user->position === 'Staff' ? 'selected' : '' }}>Staff</option>
      <option value="Manager" {{ $user->position === 'Manager' ? 'selected' : '' }}>Manager</option>
      <option value="Admin" {{ $user->position === 'Admin' ? 'selected' : '' }}>Admin</option>
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection