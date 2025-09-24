@extends('layouts.app')

@section('title', 'Daftar Batch Bahan Baku')

@section('content')
    <h1>Daftar Batch Bahan Baku</h1>
    @php
        $route = Auth::user()->position === 'Admin' 
            ? 'raw-material-batches.create' : 
            (Auth::user()->position === 'Staff' ? 'staff.raw-material-batches.create' : 'home');
    @endphp
    <a href="{{ route($route) }}" class="btn btn-primary mb-3">Tambah Batch Baru</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Kode Batch</th>
                <th>Jenis Bahan</th>
                <th>Tanggal Diterima</th>
                <th>Status</th>
                <th>Gudang</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($batches as $batch)
                <tr>
                    <td>{{ $batch->id }}</td>
                    <td>{{ $batch->batch_code }}</td>
                    <td>{{ $batch->material_type }}</td>
                    <td>{{ $batch->received_date }}</td>
                    <td>{{ $batch->status }}</td>
                    <td>
                        @foreach($batch->rawMaterialStock as $stock)
                            {{ $stock->warehouse->name }} ({{ $stock->quantity }} {{ $stock->unit }})<br>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('raw-material-batches.show', $batch->id) }}" class="btn btn-info btn-sm">Lihat</a>
                        <a href="{{ route('raw-material-batches.edit', $batch->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('raw-material-batches.destroy', $batch->id) }}" method="POST" class="d-inline">
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