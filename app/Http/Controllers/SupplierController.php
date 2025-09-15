<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    // List semua supplier
    public function index()
    {
        // urutan berdasarkan status, aktif di atas inaktif
        $suppliers = Supplier::orderByRaw("status = 'Inactive'")->get();
        return view('suppliers.index', compact('suppliers'));
    }

    // Form tambah supplier
    public function create()
    {
        return view('suppliers.create');
    }

    // Simpan supplier baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:150',
            'contact_person' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:100',
            'address' => 'nullable|string',
        ]);

        Supplier::create($request->all());

        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil ditambahkan.');
    }

    public function toggleStatus($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->status = $supplier->status === 'Active' ? 'Inactive' : 'Active';
        $supplier->save();

        return redirect()->route('suppliers.index')->with('success', 'Status supplier berhasil diubah.');
    }

    
}
