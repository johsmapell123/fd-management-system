<!DOCTYPE html>
<html>
<head>
    <title>Tambah Supplier</title>
</head>
<body>
    <a href="{{ route('suppliers.index') }}" class="btn btn-primary">Dashboard</a>
    <h1>Tambah Supplier Baru</h1>

    <form method="POST" action="{{ route('suppliers.store') }}">
        @csrf
        <label>Nama Supplier:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Contact Person:</label><br>
        <input type="text" name="contact_person"><br><br>

        <label>Telepon:</label><br>
        <input type="text" name="phone"><br><br>

        <label>Email:</label><br>
        <input type="email" name="email"><br><br>

        <label>Alamat:</label><br>
        <textarea name="address"></textarea><br><br>

        <label>Status:</label><br>
        <select name="status">
            <option value="Active" selected>Active</option>
            <option value="Inactive">Inactive</option>
        </select><br><br>

        <button type="submit">Simpan</button>
    </form>

</body>
</html>
