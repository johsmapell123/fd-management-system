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

    <a href="{{ route('production_batches.create') }}">+ Tambah Batch Produksi</a>

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
                    @foreach($batch->materials as $mat)
                        {{ $mat->rawMaterial->batch_code }} - {{ $mat->quantity_used }} {{ $mat->rawMaterial->unit }} <br>
                    @endforeach
                </td>
            </tr>
        @endforeach
    </table>
</body>
</html>
