<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductionMaterial;
use App\Models\RawMaterialStock;

class ProductionMaterialController extends Controller
{
  public function index()
  {
    $materials = ProductionMaterial::with('productionBatch', 'rawMaterialBatch')->get();
    return view('production-materials.index', compact('materials'));
  }

  // Store biasanya dari production batch, tapi contoh manual
  public function store(Request $request)
  {
    if (Auth::user()->position !== 'Staff' && Auth::user()->position !== 'Manager') {
      return redirect()->back()->with('error', 'Access denied.');
    }
    $validated = $request->validate([
      'production_id' => 'required|exists:production_batches,production_id',
      'raw_batch_id' => 'required|exists:raw_material_batches,batch_id',
      'material_type' => 'required|in:Flour,Salt,Kansui',
      'quantity_used' => 'nullable|numeric',
    ]);
    ProductionMaterial::create($validated);
    // Update stok otomatis
    $rawStock = RawMaterialStock::where('raw_batch_id', $validated['raw_batch_id'])->first();
    if ($rawStock) {
      $rawStock->available_quantity -= $validated['quantity_used'];
      $rawStock->save();
    }
    return redirect()->back()->with('success', 'Material added.');
  }

  public function destroy(ProductionMaterial $productionMaterial)
  {
    if (Auth::user()->position !== 'Admin') {
      return redirect()->back()->with('error', 'Access denied.');
    }
    $productionMaterial->delete();
    return redirect()->back()->with('success', 'Material deleted.');
  }
}
