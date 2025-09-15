<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>
    <h1>Edit User: {{ $user->name }}</h1>

    <form method="POST" action="{{ route('users.update', $user->id) }}">
        @csrf
        @method('PUT')

        <label>Nama:</label>
        <input type="text" name="name" value="{{ $user->name }}" required><br><br>

        <label>Email:</label>
        <input type="email" name="email" value="{{ $user->email }}" required><br><br>

        <label>Password (kosongkan jika tidak diubah):</label>
        <input type="password" name="password"><br><br>

        <label>Role:</label>
        <select name="position" required>
            <option value="Admin" {{ $user->position == 'Admin' ? 'selected' : '' }}>Admin</option>
            <option value="Manager" {{ $user->position == 'Manager' ? 'selected' : '' }}>Manager</option>
            <option value="Staff" {{ $user->position == 'Staff' ? 'selected' : '' }}>Staff</option>
        </select><br><br>

        <label>Departemen (kosongkan kalau Admin):</label>
        <input type="text" name="department" value="{{ $user->department }}"><br><br>

        <button type="submit">Simpan Perubahan</button>
    </form>
</body>
</html>
