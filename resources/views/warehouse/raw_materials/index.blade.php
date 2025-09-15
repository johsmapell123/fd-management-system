<!DOCTYPE html>
<html>
<head>
    <title>Daftar Bahan Baku Masuk</title>
</head>
<body>
    <h1>Daftar Batch Bahan Baku</h1>

    <a href="{{ route('raw_materials.create') }}">+ Tambah Batch</a>
    <br><br>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="5">
        <thead>
            <tr>
                <th>Batch Code</th>
                <th>Supplier</th>
                <th>Jenis</th>
                <th>Tanggal Masuk</th>
                <th>Jumlah</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($batches as $batch)
                <tr>
                    <td>{{ $batch->batch_code }}</td>
                    <td>{{ $batch->supplier->name }}</td>
                    <td>{{ $batch->material_type }}</td>
                    <td>{{ $batch->received_date }}</td>
                    <td>{{ $batch->quantity }} {{ $batch->unit }}</td>
                    <td>{{ $batch->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
