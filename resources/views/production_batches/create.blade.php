<!DOCTYPE html>
<html>
<head>
    <title>Input Batch Produksi</title>
    <script>
        let materialIndex = 0;

        function addMaterialRow() {
            materialIndex++;
            const container = document.getElementById('materials-container');

            const row = document.createElement('div');
            row.classList.add('material-row');
            row.innerHTML = `
                <div>
                    <label>Pilih Bahan:</label>
                    <select name="materials[${materialIndex}][raw_batch_id]" required>
                        <option value="">--Pilih Batch--</option>
                        @foreach($materials as $m)
                            <option value="{{ $m->id }}">
                                {{ $m->batch_code }} - {{ $m->material_type }} ({{ $m->quantity }} {{ $m->unit }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label>Jumlah Dipakai:</label>
                    <input type="number" name="materials[${materialIndex}][quantity_used]" step="0.01" required>
                </div>
                <hr>
            `;
            container.appendChild(row);
        }
    </script>
</head>
<body>
    <h1>Input Batch Produksi</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('production_batches.store') }}">
        @csrf

        <div>
            <label>Kode Batch:</label>
            <input type="text" name="batch_code" value="{{ old('batch_code') }}" required>
        </div>

        <div>
            <label>Tanggal Produksi:</label>
            <input type="date" name="produced_date" value="{{ old('produced_date') }}" required>
        </div>

        <div>
            <label>Status:</label>
            <select name="status" required>
                <option value="Pending" {{ old('status') === 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Completed" {{ old('status') === 'Completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>

        <h3>Bahan Baku yang Dipakai</h3>
        <div id="materials-container">
            <div class="material-row">
                <div>
                    <label>Pilih Bahan:</label>
                    <select name="materials[0][raw_batch_id]" required>
                        <option value="">--Pilih Batch--</option>
                        @foreach($materials as $m)
                            <option value="{{ $m->id }}">
                                {{ $m->batch_code }} - {{ $m->material_type }} ({{ $m->quantity }} {{ $m->unit }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label>Jumlah Dipakai:</label>
                    <input type="number" name="materials[0][quantity_used]" step="0.01" required>
                </div>
                <hr>
            </div>
        </div>

        <button type="button" onclick="addMaterialRow()">+ Tambah Bahan</button>
        <br><br>

        <button type="submit">Simpan</button>
    </form>
</body>
</html>
