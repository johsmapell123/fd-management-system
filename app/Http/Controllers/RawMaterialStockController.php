<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RawMaterialStock;
use Illuminate\Support\Facades\Auth;


class RawMaterialStockController extends Controller
{
  public function index()
  {
    $stocks = RawMaterialStock::with('rawMaterialBatch', 'warehouse')->latest()->get();
    return view('warehouse.raw_materials.raw_material_stocks.index', compact('stocks'));
  }

  public function show(RawMaterialStock $rawMaterialStock) 
  {
    $rawMaterialStock->load('rawMaterialBatch', 'warehouse')->get();
    return view('warehouse.raw_materials.raw_material_stocks.show', compact('rawMaterialStock'));
  }

  // Lainnya bisa ditambahkan jika perlu manual input, tapi biasanya otomatis dari batch
  // Contoh update manual untuk adjustment
  public function update(Request $request, RawMaterialStock $rawMaterialStock)
  {
    if (Auth::user()->position !== 'Manager' && Auth::user()->position !== 'Admin') {
      return redirect()->back()->with('error', 'Access denied.');
    }
    $validated = $request->validate([
      'available_quantity' => 'required|numeric',
      'unit' => 'nullable|string|max:20',
    ]);
    $rawMaterialStock->update($validated);
    return redirect()->route('raw-material-stocks.index')->with('success', 'Stock updated.');
  }
}
