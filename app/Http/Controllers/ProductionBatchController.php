<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\ProductionBatch;
use App\Models\RawMaterialBatch;
use App\Models\RawMaterialStock;


class ProductionBatchController extends Controller
{
    public function index()
    {
        $batches = ProductionBatch::with('productionMaterials', 'finishedGoodsStock', 'qualityControlResults')->get();
        return view('production-batches.index', compact('batches'));
    }

    public function create()
    {
        // Ambil hanya bahan baku yg statusnya "In Use"
        $rawBatches = RawMaterialBatch::where('status', 'In Use')->get();
        return view('production-batches.create', compact('rawBatches'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'production_date' => 'nullable|date',
            'shift' => 'nullable|in:A,B,C',
            'quantity_carton' => 'nullable|integer',
            'notes' => 'nullable|string',
        ]);
        // Generate production code otomatis
        $validated['production_code'] = 'RSN-' . date('Ymd') . '-' . Str::random(1);
        $batch = ProductionBatch::create($validated);
        // Tambah bahan (contoh sederhana, bisa dari form array)
        if ($request->has('materials')) {
            foreach ($request->materials as $material) {
                $batch->productionMaterials()->create([
                    'raw_batch_id' => $material['raw_batch_id'],
                    'material_type' => $material['material_type'],
                    'quantity_used' => $material['quantity_used'],
                ]);
                // Update stok otomatis
                $rawStock = RawMaterialStock::where('raw_batch_id', $material['raw_batch_id'])->first();
                if ($rawStock) {
                    $rawStock->available_quantity -= $material['quantity_used'];
                    $rawStock->save();
                }
            }
        }
        return redirect()->route('production-batches.index')->with('success', 'Production batch created.');
    }

    public function show(ProductionBatch $productionBatch)
    {
        $productionBatch->load('productionMaterials', 'finishedGoodsStock', 'qualityControlResults');
        return view('production-batches.show', compact('productionBatch'));
    }

    public function edit(ProductionBatch $productionBatch)
    {
        if (Auth::user()->position !== 'Manager' && Auth::user()->position !== 'Admin') {
            return redirect()->back()->with('error', 'Access denied.');
        }
        return view('production-batches.edit', compact('productionBatch'));
    }

    public function update(Request $request, ProductionBatch $productionBatch)
    {
        if (Auth::user()->position !== 'Manager' && Auth::user()->position !== 'Admin') {
            return redirect()->back()->with('error', 'Access denied.');
        }
        $validated = $request->validate([
            'status' => 'required|in:In Production,In Warehouse', // Validasi selesai
            'notes' => 'nullable|string',
        ]);
        $productionBatch->update($validated);
        return redirect()->route('production-batches.index')->with('success', 'Production batch updated.');
    }

    public function destroy(ProductionBatch $productionBatch)
    {
        if (Auth::user()->position !== 'Admin') {
            return redirect()->back()->with('error', 'Access denied.');
        }
        $productionBatch->delete();
        return redirect()->route('production-batches.index')->with('success', 'Production batch deleted.');
    }
}
