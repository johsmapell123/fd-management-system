<!DOCTYPE html>
<html>
<head>
    <title>Daftar Supplier</title>
    <style>
        .inactive {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Daftar Supplier</h1>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Dashboard</a>
    

    <a href="{{ route('suppliers.create') }}">Tambah Supplier Baru</a>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Kontak</th>
            <th>Telepon</th>
            <th>Email</th>
            <th>Alamat</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        @foreach($suppliers as $supplier)
        <tr class="{{ $supplier->status === 'Inactive' ? 'inactive' : '' }}">
            <td>{{ $supplier->id }}</td>
            <td>{{ $supplier->name }}</td>
            <td>{{ $supplier->contact_person }}</td>
            <td>{{ $supplier->phone }}</td>
            <td>{{ $supplier->email }}</td>
            <td>{{ $supplier->address }}</td>
            <td>{{ $supplier->status }}</td>
            <td>
                <form method="POST" action="{{ route('suppliers.toggleStatus', $supplier->id) }}">
                    @csrf
                    <button type="submit">
                        {{ $supplier->status === 'Active' ? 'Nonaktifkan' : 'Aktifkan' }}
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

</body>
</html>
