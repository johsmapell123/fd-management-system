@extends('layouts.app')

@section('title', 'Daftar Stok Bahan Baku')

@section('content')
    <h1>Daftar Stok Bahan Baku</h1>
    <a href="{{ route('raw-material-stocks.create') }}" class="btn btn-primary mb-3">Tambah Stok Baru</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Kode Batch</th>
                <th>Jumlah</th>
                <th>Satuan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stocks as $index => $stock)
                <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ $stock->rawMaterialBatch->batch_code }}</td>
                    <td>{{ intval($stock->available_quantity) }}</td>
                    <td>{{ $stock->unit }}</td>
                    <td>
                        <a href="{{ route('raw-material-stocks.show', $stock->id) }}" class="btn btn-info btn-sm">Lihat</a>
                        {{-- <a href="{{ route('raw-material-stocks.edit', $stock->id) }}" class="btn btn-warning btn-sm">Edit</a> --}}
                        <form action="{{ route('raw-material-stocks.destroy', $stock->id) }}" method="POST" class="d-inline">
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