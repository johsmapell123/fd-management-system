<!DOCTYPE html>
<html>
<head>
    <title>Tambah Batch Bahan Baku</title>
</head>
<body>
    <h1>Input Batch Bahan Baku</h1>

    <form method="POST" action="{{ route('raw_materials.store') }}">
        @csrf

        <label>Supplier:</label>
        <select name="supplier_id" required>
            <option value="">-- Pilih Supplier --</option>
            @foreach($suppliers as $supplier)
                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
            @endforeach
        </select><br><br>

        <label>Jenis Bahan:</label>
        <select name="material_type" required>
            <option value="Flour">Flour</option>
            <option value="Salt">Salt</option>
            <option value="Kansui">Kansui</option>
        </select><br><br>

        <label>Tanggal Masuk:</label>
        <input type="date" name="received_date" required><br><br>

        <label>Jumlah:</label>
        <input type="number" step="0.01" name="quantity" required><br><br>

        <label>Satuan:</label>
        <input type="text" name="unit" placeholder="kg, liter, dll" required><br><br>

        <button type="submit">Simpan</button>
    </form>
</body>
</html>
