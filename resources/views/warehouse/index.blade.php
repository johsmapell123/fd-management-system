@extends('layouts.app')

@section('title', 'Daftar Gudang')

@section('content')
    <h1>Daftar Gudang</h1>
    <a href="{{ route('warehouses.create') }}" class="btn btn-primary mb-3">Tambah Gudang Baru</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Gudang</th>
                <th>Lokasi</th>
                <th>Batch Terkait</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($warehouses as $warehouse)
                <tr>
                    <td>{{ $warehouse->id }}</td>
                    <td>{{ $warehouse->name }}</td>
                    <td>{{ $warehouse->location }}</td>
                    <td>
                        @if ($warehouse->rawMaterialStock->isEmpty())
                            <em>-</em>
                        @endif
                        @foreach($warehouse->rawMaterialStock as $stock)
                            {{ $stock->rawMaterialBatch->batch_code }} ({{ $stock->available_quantity }} {{ $stock->unit }})<br>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('warehouses.show', $warehouse->id) }}" class="btn btn-info btn-sm">Lihat</a>
                        <a href="{{ route('warehouses.edit', $warehouse->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('warehouses.destroy', $warehouse->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection