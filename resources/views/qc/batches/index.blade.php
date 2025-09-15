<!DOCTYPE html>
<html>
<head>
    <title>QC - Cek Bahan Baku</title>
</head>
<body>
    <h1>QC - Daftar Batch Bahan Baku</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    @if(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
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
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($batches as $batch)
                <tr @if($batch->status == 'Rejected') style="background: #f8d7da;" @endif>
                    <td>{{ $batch->batch_code }}</td>
                    <td>{{ $batch->supplier->name }}</td>
                    <td>{{ $batch->material_type }}</td>
                    <td>{{ $batch->received_date }}</td>
                    <td>{{ $batch->quantity }} {{ $batch->unit }}</td>
                    <td>{{ $batch->status }}</td>
                    <td>
                        @if($batch->status == 'OK')
                            <!-- NOTE: gunakan $batch->id (bukan batch_id) -->
                            <form method="POST" action="{{ route('qc.approve', $batch->id) }}" style="display:inline;" onsubmit="return confirmApprove('{{ $batch->batch_code }}')">
                                @csrf
                                <button type="submit">Approve</button>
                            </form>

                            <form method="POST" action="{{ route('qc.reject', $batch->id) }}" style="display:inline;" onsubmit="return confirmReject('{{ $batch->batch_code }}')">
                                @csrf
                                <button type="submit" style="color:red;">Reject</button>
                            </form>
                        @else
                            <i>Tidak ada aksi</i>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

<script>
function confirmApprove(code) {
    return confirm("Yakin ingin APPROVE batch " + code + "?\nAksi ini akan menandai batch sebagai 'In Use' dan dapat dipakai produksi.");
}

function confirmReject(code) {
    return confirm("Yakin ingin REJECT batch " + code + "?\nAksi ini akan menandai batch sebagai 'Rejected' dan tidak bisa dipakai produksi.");
}
</script>
</body>
</html>
