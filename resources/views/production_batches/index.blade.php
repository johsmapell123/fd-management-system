<!DOCTYPE html>
<html>
<head>
    <title>Daftar Batch Produksi</title>
</head>
<body>
    <h1>Daftar Batch Produksi</h1>

    @if(session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @endif

    @if (Auth::user()->position === 'Admin')
        <a href="{{ route('production-batches.create') }}">+ Tambah Batch Produksi</a>
    @endif
    {{-- <a href="{{ route($route) }}">+ Tambah Batch Produksi</a> --}}

    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Kode Produksi</th>
            <th>Tanggal</th>
            <th>Shift</th>
            <th>Jumlah Karton</th>
            <th>Status</th>
            <th>Bahan Baku</th>
        </tr>
        @foreach($batches as $batch)
            <tr>
                <td>{{ $batch->production_code }}</td>
                <td>{{ $batch->production_date }}</td>
                <td>{{ $batch->shift }}</td>
                <td>{{ $batch->quantity_carton }}</td>
                <td>{{ $batch->status }}</td>
                <td>
                    @foreach($batch->productionMaterials as $mat)
                        {{ $mat->rawMaterialBatch->batch_code }} - {{ $mat->quantity_used }} {{ $mat->rawMaterialBatch->unit }} <br>
                    @endforeach
                </td>
            </tr>
        @endforeach
    </table>
</body>
</html>
