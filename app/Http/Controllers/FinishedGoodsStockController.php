<?php

namespace App\Http\Controllers;

use App\Models\FinishedGoodsStock;
use App\Models\ProductionBatch;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinishedGoodsStockController extends Controller
{
  public function index()
  {
    $stocks = FinishedGoodsStock::with('productionBatch', 'warehouse')->orderBy('entry_date')->get(); // Untuk FIFO
    return view('finished-goods-stocks.index', compact('stocks'));
  }

  public function create()
  {
    $productionBatches = ProductionBatch::where('status', 'In Warehouse')->get();
    $warehouses = Warehouse::where('type', 'FinishedGoods')->get();
    return view('finished-goods-stocks.create', compact('productionBatches', 'warehouses'));
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'production_id' => 'required|exists:production_batches,production_id',
      'warehouse_id' => 'required|exists:warehouses,warehouse_id',
      'available_carton' => 'nullable|integer',
      'entry_date' => 'nullable|date',
    ]);
    FinishedGoodsStock::create($validated);
    return redirect()->route('finished-goods-stocks.index')->with('success', 'Finished goods stock created.');
  }

  public function update(Request $request, FinishedGoodsStock $finishedGoodsStock)
  {
    if (Auth::user()->position !== 'Manager' && Auth::user()->position !== 'Admin') {
      return redirect()->back()->with('error', 'Access denied.');
    }
    $validated = $request->validate([
      'available_carton' => 'required|integer',
    ]);
    $finishedGoodsStock->update($validated);
    return redirect()->route('finished-goods-stocks.index')->with('success', 'Stock updated.');
  }
}
