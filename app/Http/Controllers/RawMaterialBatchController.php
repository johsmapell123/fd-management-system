<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RawMaterialBatch;
use App\Models\Supplier;

class RawMaterialBatchController extends Controller
{
    public function index()
    {
        $batches = RawMaterialBatch::with('supplier')->latest()->get();
        return view('warehouse.raw_materials.index', compact('batches'));
    }

    public function create()
    {
        $suppliers = Supplier::where('status', 'Active')->get();
        return view('warehouse.raw_materials.create', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'material_type' => 'required|in:Flour,Salt,Kansui',
            'received_date' => 'required|date',
            'quantity' => 'required|numeric|min:1',
            'unit' => 'required|string',
        ]);

        // Buat batch code unik: SUPPLIERID-TANGGAL-RANDOM
        $batchCode = "SUP" . $request->supplier_id . "-" . now()->format('ymd') . "-" . rand(100, 999);

        RawMaterialBatch::create([
            'batch_code' => $batchCode,
            'supplier_id' => $request->supplier_id,
            'material_type' => $request->material_type,
            'received_date' => $request->received_date,
            'quantity' => $request->quantity,
            'unit' => $request->unit,
            'status' => 'OK',
        ]);

        return redirect()->route('raw_materials.index')->with('success', 'Batch bahan baku berhasil ditambahkan.');
    }
}
