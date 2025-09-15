<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Selamat datang, {{ auth()->user()->name }} (Admin)</h1>

    <ul>
        <li><a href="{{ route('users.index') }}">Kelola Users</a></li>
        <li><a href="{{ route('suppliers.index') }}">Kelola Suppliers bisaaaa</a></li>
        <li><a href="#">Laporan Produksi</a></li>
        <li><a href="#">Laporan Gudang</a></li>
    </ul>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
    
</body>
</html>
