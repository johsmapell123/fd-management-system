<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - UMKM Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="/">UMKM Tracker</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @auth
                        @if(Auth::user()->position === 'Staff')
                            <li class="nav-item"><a class="nav-link" href="{{ route('raw-material-batches.create') }}">Terima Bahan Baku</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('production-batches.create') }}">Mulai Produksi</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('finished-goods-stocks.create') }}">Terima Produk Jadi</a></li>
                        @elseif(Auth::user()->position === 'Manager')
                            <li class="nav-item"><a class="nav-link" href="/manager/dashboard">Dashboard Laporan</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('production-batches.index') }}">Validasi Produksi</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('quality-control-results.index') }}">Validasi QC</a></li>
                        @elseif(Auth::user()->position === 'Admin')
                            <li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}">Manajemen User</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('suppliers.index') }}">Supplier</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('warehouses.index') }}">Gudang</a></li>
                            <li class="nav-item"><a class="nav-link" href="/admin/dashboard">Dashboard Admin</a></li>
                        @endif
                        <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}">Logout</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <footer class="bg-light text-center py-3 mt-5">
        <p>&copy; 2025 UMKM Tracker</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>