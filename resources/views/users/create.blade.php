<!DOCTYPE html>
<html>
<head>
    <title>Tambah User Baru</title>
</head>
<body>
    <h1>Tambah User Baru</h1>

    <form method="POST" action="{{ route('users.store') }}">
        @csrf
        <label>Nama:</label>
        <input type="text" name="name" required><br><br>

        <label>Email:</label>
        <input type="email" name="email" required><br><br>

        <label>Password:</label>
        <input type="password" name="password" required><br><br>

        <label>Role:</label>
<select name="position" id="position" required onchange="toggleDepartment()">
    <option value="Admin">Admin</option>
    <option value="Manager">Manager</option>
    <option value="Staff">Staff</option>
</select><br><br>

<div id="departmentField">
    <label>Departemen:</label>
    <select name="department">
        <option value="Production">Production</option>
        <option value="QC">QC</option>
        <option value="Warehouse">Warehouse</option>
    </select><br><br>
</div>

        {{-- <label>Role:</label>
        <select name="position" required>
            <option value="Admin">Admin</option>
            <option value="Manager">Manager</option>
            <option value="Staff">Staff</option>
        </select><br><br> --}}

        {{-- <label>Departemen (optional untuk Staff):</label>
        <input type="text" name="department"><br><br> --}}

        <button type="submit">Simpan</button>
    </form>

    <script>
function toggleDepartment() {
    let role = document.getElementById("position").value;
    let deptField = document.getElementById("departmentField");

    if (role === "Staff") {
        deptField.style.display = "block";
    } else {
        deptField.style.display = "none";
    }
}
window.onload = toggleDepartment;
</script>
</body>
</html>
