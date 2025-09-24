<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use App\Models\RawMaterialBatch;
use App\Models\RawMaterialStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WarehouseController extends Controller
{
  public function index()
  {
    $warehouses = Warehouse::with('rawMaterialStock', 'finishedGoodsStock')->get();
    return view('warehouse.index', compact('warehouses'));
  }

  public function create()
  {
    if (Auth::user()->position !== 'Admin') {
      return redirect()->back()->with('error', 'Access denied.');
    }

    $batches = RawMaterialBatch::all();
    $stocks = RawMaterialStock::all();

    return view('warehouse.create', compact('batches', 'stocks'));
  }

  public function store(Request $request)
  {
    if (Auth::user()->position !== 'Admin') {
      return redirect()->back()->with('error', 'Access denied.');
    }
    $validated = $request->validate([
      'name' => 'nullable|string|max:100',
      'type' => 'required|in:RawMaterial,FinishedGoods',
      'location' => 'nullable|string|max:100',
    ]);
    Warehouse::create($validated);
    return redirect()->route('warehouses.index')->with('success', 'Warehouse created.');
  }

  public function show(Warehouse $warehouse)
  {
    $warehouse->load('rawMaterialStock', 'finishedGoodsStock');
    return view('warehouse.show', compact('warehouse'));
  }

  public function edit(Warehouse $warehouse)
  {
    if (Auth::user()->position !== 'Admin') {
      return redirect()->back()->with('error', 'Access denied.');
    }
    
    $batches = RawMaterialBatch::all();
    $stocks = RawMaterialStock::all();

    return view('warehouse.edit', compact('warehouse', 'batches', 'stocks'));
  }

  public function update(Request $request, Warehouse $warehouse)
  {
    if (Auth::user()->position !== 'Admin') {
      return redirect()->back()->with('error', 'Access denied.');
    }
    $validated = $request->validate([
      'name' => 'nullable|string|max:100',
      'type' => 'required|in:RawMaterial,FinishedGoods',
      'location' => 'nullable|string|max:100',
    ]);
    $warehouse->update($validated);
    return redirect()->route('warehouses.index')->with('success', 'Warehouse updated.');
  }

  public function destroy(Warehouse $warehouse)
  {
    if (Auth::user()->position !== 'Admin') {
      return redirect()->back()->with('error', 'Access denied.');
    }
    $warehouse->delete();
    return redirect()->route('warehouses.index')->with('success', 'Warehouse deleted.');
  }
}
