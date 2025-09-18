<?php

namespace App\Http\Controllers;

use App\Models\QualityControlResult;
use App\Models\ProductionBatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QualityControlResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $results = QualityControlResult::with('productionBatch')->get();
        return view('quality-control-results.index', compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productionBatches = ProductionBatch::all();
        return view('quality-control-results.create', compact('productionBatches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'production_id' => 'required|exists:production_batches,production_id',
            'sample_count' => 'nullable|integer',
            'result' => 'nullable|string|max:100',
            'status' => 'in:Pass,Fail',
            'defect_type' => 'nullable|string|max:100',
            'action_taken' => 'nullable|string',
        ]);
        QualityControlResult::create($validated);
        return redirect()->route('quality-control-results.index')->with('success', 'QC result created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(QualityControlResult $qualityControlResult)
    {
        $qualityControlResult->load('productionBatch');
        return view('quality-control-results.show', compact('qualityControlResult'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(QualityControlResult $qualityControlResult)
    {
        if (Auth::user()->position !== 'Manager' && Auth::user()->position !== 'Admin') {
            return redirect()->back()->with('error', 'Access denied.');
        }
        $productionBatches = ProductionBatch::all();
        return view('quality-control-results.edit', compact('qualityControlResult', 'productionBatches'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, QualityControlResult $qualityControlResult)
    {
        if (Auth::user()->position !== 'Manager' && Auth::user()->position !== 'Admin') {
            return redirect()->back()->with('error', 'Access denied.');
        }
        $validated = $request->validate([
            'status' => 'required|in:Pass,Fail', // Approve/fail
            'action_taken' => 'nullable|string',
        ]);
        $qualityControlResult->update($validated);
        return redirect()->route('quality-control-results.index')->with('success', 'QC result updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QualityControlResult $qualityControlResult)
    {
        if (Auth::user()->position !== 'Admin') {
            return redirect()->back()->with('error', 'Access denied.');
        }
        $qualityControlResult->delete();
        return redirect()->route('quality-control-results.index')->with('success', 'QC result deleted.');
    }
}
