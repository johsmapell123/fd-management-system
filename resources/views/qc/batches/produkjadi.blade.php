<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>QC Produk Jadi</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6 font-sans">
  <h1 class="text-2xl font-bold mb-6">QC - Cek Produk Jadi</h1>

  <table class="w-full bg-white shadow rounded-lg overflow-hidden">
    <thead class="bg-gray-200">
      <tr>
        <th class="px-4 py-2">Kode Produksi</th>
        <th class="px-4 py-2">Tanggal</th>
        <th class="px-4 py-2">Shift</th>
        <th class="px-4 py-2">Jumlah Karton</th>
        <th class="px-4 py-2">Status</th>
        <th class="px-4 py-2">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td class="px-4 py-2">RSN-250910-A</td>
        <td class="px-4 py-2">2025-09-10</td>
        <td class="px-4 py-2">A</td>
        <td class="px-4 py-2">500</td>
        <td class="px-4 py-2 text-yellow-600 font-semibold">Menunggu QC</td>
        <td class="px-4 py-2 space-x-2">
          <button class="bg-green-500 text-white px-3 py-1 rounded">Approve</button>
          <button class="bg-red-500 text-white px-3 py-1 rounded">Reject</button>
        </td>
      </tr>
    </tbody>
  </table>
</body>
</html>
