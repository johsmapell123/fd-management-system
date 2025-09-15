<!DOCTYPE html>
<html>
<head>
    <title>Kelola Users</title>
</head>
<body>
    <h1>Daftar Users</h1>

    <a href="{{ route('users.create') }}">Tambah User Baru</a>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
            <th>Departemen</th>
            <th>Aksi</th>
        </tr>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->position }}</td>
            <td>{{ $user->department }}</td>
            <td>
                <a href="{{ route('users.edit', $user->id) }}">Edit</a> |
                <form method="POST" action="{{ route('users.destroy', $user->id) }}" onsubmit="return confirm('Yakin mau hapus user ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

</body>
</html>
