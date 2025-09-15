<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductionBatch;
use App\Models\RawMaterialBatch;
use App\Models\ProductionMaterial;
use Carbon\Carbon;


class ProductionBatchController extends Controller
{
    public function index()
    {
        $batches = ProductionBatch::with('materials.rawMaterial')->get();
        return view('production_batches.index', compact('batches'));
    }

    public function create()
    {
        // Ambil hanya bahan baku yg statusnya "In Use"
        $rawMaterials = RawMaterialBatch::where('status', 'OK')->get();
        return view('production_batches.create', compact('materials'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'batch_code' => 'required|unique:production_batches',
            'produced_date' => 'required|date',
            'raw_batch_id' => 'required|array',
            'raw_batch_id.*' => 'exists:raw_material_batches,id',
            'quantity_used.*' => 'required|numeric|min:0.01',
        ]);

        // Simpan batch produksi
        $production = ProductionBatch::create([
            'batch_code' => $request->batch_code,
            'produced_date' => $request->produced_date,
            'status' => 'In Production',
        ]);

        // Loop bahan baku
        foreach ($request->raw_batch_id as $key => $raw_batch_id) {
            $quantityUsed = $request->quantity_used[$key];

            // Simpan ke tabel production_materials
            ProductionMaterial::create([
                'production_id' => $production->id,
                'raw_batch_id' => $raw_batch_id,
                'material_type' => RawMaterialBatch::find($raw_batch_id)->material_type,
                'quantity_used' => $quantityUsed,
            ]);

            // Kurangi stok bahan baku
            $rawBatch = RawMaterialBatch::find($raw_batch_id);
            $rawBatch->quantity -= $quantityUsed;

            // Kalau stok habis, status ubah jadi 'In Use' atau 'Finished'
            if ($rawBatch->quantity <= 0) {
                $rawBatch->status = 'In Use';
            }

            $rawBatch->save();
        }

        return redirect()->route('production_batches.index')
            ->with('success', 'Batch produksi berhasil ditambahkan');
    }
}
