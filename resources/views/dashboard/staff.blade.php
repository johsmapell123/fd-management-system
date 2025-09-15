<!DOCTYPE html>
<html>
<head>
    <title>Staff Dashboard</title>
</head>
<body>
    <h1>Selamat datang, {{ Auth::user()->name }} (Staff)</h1>

    <ul>
        @if(Auth::user()->department === 'Warehouse')
            <li><a href="{{ route('raw_materials.index') }}">Input Bahan Baku Masuk</a></li>
            <li><a href="#">Input Produk Jadi ke Gudang</a></li>
            <li><a href="#">Lihat Stok Gudang</a></li>
        @elseif(Auth::user()->department === 'Production')
            <li><a href="{{ route('production_batches.index') }}">Input Batch Produksi</a></li>
            <li><a href="#">Pakai Bahan Baku</a></li>
            <li><a href="#">Laporan Shift</a></li>
        @elseif(Auth::user()->department === 'QC')
            <li><a href="{{ route('qc.index') }}">Cek Kualitas Bahan Baku</a></li>
            <li><a href="#">Approve/Reject Batch</a></li>
        @endif
    </ul>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>
