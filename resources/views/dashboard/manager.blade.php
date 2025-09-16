<!DOCTYPE html>
<html>
<head>
    <title>Manager Dashboard</title>
</head>
<body>
    <h1>Selamat datang, {{ Auth::user()->name }} ({{ Auth::user()->position }})</h1>

    <ul>
        <li><a href="#">Review Produksi</a></li>
        <li><a href="#">Approve Hasil Produksi</a></li>
        <li><a href="#">Laporan Konsumsi Bahan</a></li>
    </ul>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
    
</body>
</html>
