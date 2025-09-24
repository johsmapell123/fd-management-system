<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\RawMaterialBatch;
use App\Models\Supplier;
use App\Models\Warehouse;

class RawMaterialBatchController extends Controller
{
    public function index()
    {
        $batches = RawMaterialBatch::with('supplier', 'rawMaterialStock')->get();
        return view('warehouse.raw_materials.index', compact('batches'));
    }

    public function show($id)
    {
        $batch = RawMaterialBatch::with('supplier', 'rawMaterialStock.warehouse')->findOrFail($id);
        return view('warehouse.raw_materials.show', compact('batch'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        $warehouses = Warehouse::all();
        return view('warehouse.raw_materials.create', compact('suppliers', 'warehouses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,supplier_id',
            'material_type' => 'required|in:Flour,Salt,Kansui',
            'received_date' => 'nullable|date',
            'quantity' => 'nullable|numeric',
            'unit' => 'nullable|string|max:20',
            'notes' => 'nullable|string',
        ]);

        // Generate batch code otomatis, contoh: PM-YYYYMMDD-XX
        $validated['batch_code'] = 'PM-' . date('Ymd') . '-' . Str::random(2);
        $batch = RawMaterialBatch::create($validated);

        // Otomatis buat stok awal jika ada warehouse default (asumsikan warehouse_id=1)
        $batch->rawMaterialStock()->create([
            'warehouse_id' => 1, // Ganti dengan logic dynamic
            'available_quantity' => $validated['quantity'],
            'unit' => $validated['unit'],
        ]);
        return redirect()->route('raw-material-batches.index')->with('success', 'Batch created.');
    }

    public function edit($id)
    {
        $batch = RawMaterialBatch::findOrFail($id);
        $suppliers = Supplier::all();
        $warehouses = Warehouse::all();
        return view('warehouse.raw_materials.edit', compact('batch', 'suppliers', 'warehouses'));
    }
}
