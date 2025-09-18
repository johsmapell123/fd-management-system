<?php


namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    // List semua supplier
    public function index()
    {
        $suppliers = Supplier::with('contracts')->get();
        return view('suppliers.index', compact('suppliers'));
    }

    // Form tambah supplier
    public function create()
    {
        if (Auth::user()->position === 'Staff' || Auth::user()->position === 'Manager' || Auth::user()->position === 'Admin') {
            return view('suppliers.create');
        }
        return redirect()->back()->with('error', 'Access denied.');
    }

    // Simpan supplier baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'contact_person' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:100',
            'address' => 'nullable|string',
        ]);
        Supplier::create($validated);
        return redirect()->route('suppliers.index')->with('success', 'Supplier created.');
    }

    public function show(Supplier $supplier)
    {
        $supplier->load('contracts', 'rawMaterialBatches');
        return view('suppliers.show', compact('supplier'));
    }

    public function edit(Supplier $supplier)
    {
        if (Auth::user()->position === 'Manager' || Auth::user()->position === 'Admin') {
            return view('suppliers.edit', compact('supplier'));
        }
        return redirect()->back()->with('error', 'Access denied.');
    }

    public function update(Request $request, Supplier $supplier)
    {
        if (Auth::user()->position !== 'Manager' && Auth::user()->position !== 'Admin') {
            return redirect()->back()->with('error', 'Access denied.');
        }
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'contact_person' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:100',
            'address' => 'nullable|string',
        ]);
        $supplier->update($validated);
        return redirect()->route('suppliers.index')->with('success', 'Supplier updated.');
    }

    public function destroy(Supplier $supplier)
    {
        if (Auth::user()->position !== 'Admin') {
            return redirect()->back()->with('error', 'Access denied.');
        }
        $supplier->delete();
        return redirect()->route('suppliers.index')->with('success', 'Supplier deleted.');
    }

    public function toggleStatus($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->status = $supplier->status === 'Active' ? 'Inactive' : 'Active';
        $supplier->save();

        return redirect()->route('suppliers.index')->with('success', 'Status supplier berhasil diubah.');
    }
}
