@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')
<h1>Tambah User</h1>
<form action="{{ route('users.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Nama</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <div class="mb-3">
        <label for="department" class="form-label">Departemen</label>
        <select class="form-select" id="department" name="department" required>
            <option value="Production">Production</option>
            <option value="QC">QC</option>
            <option value="Warehouse">Warehouse</option>
            <option value="Admin">Admin</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="position" class="form-label">Posisi</label>
        <select class="form-select" id="position" name="position" required>
            <option value="Staff">Staff</option>
            <option value="Manager">Manager</option>
            <option value="Admin">Admin</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
@endsection