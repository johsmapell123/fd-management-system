@extends('layouts.app')

@section('title', 'Daftar Supplier')

@section('content')
<h1>Daftar Supplier</h1>
<a href="{{ route('suppliers.create') }}" class="btn btn-primary mb-3">Tambah Supplier</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Kontak</th>
            <th>Telepon</th>
            <th>Email</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($suppliers as $supplier)
        <tr>
            <td>{{ $supplier->name }}</td>
            <td>{{ $supplier->contact_person }}</td>
            <td>{{ $supplier->phone }}</td>
            <td>{{ $supplier->email }}</td>
            <td>{{ $supplier->address }}</td>
            <td>
                <a href="{{ route('suppliers.show', $supplier) }}" class="btn btn-info btn-sm">Detail</a>
                <a href="{{ route('suppliers.edit', $supplier) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm"
                        onclick="return confirm('Yakin hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection