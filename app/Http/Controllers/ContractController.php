<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contracts = Contract::with('supplier')->get();
        return view('contracts.index', compact('contracts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::all();
        return view('contracts.create', compact('suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,supplier_id',
            'material_type' => 'required|in:Flour,Salt,Kansui',
            'price' => 'nullable|numeric',
            'delivery_schedule' => 'nullable|string|max:100',
            'contract_duration' => 'nullable|date',
            'payment_status' => 'in:Pending,Paid',
        ]);
        Contract::create($validated);
        return redirect()->route('contracts.index')->with('success', 'Contract created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contract $contract)
    {
        $contract->load('supplier');
        return view('contracts.show', compact('contract'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contract $contract)
    {
        if (Auth::user()->position === 'Manager' || Auth::user()->position === 'Admin') {
            $suppliers = Supplier::all();
            return view('contracts.edit', compact('contract', 'suppliers'));
        }
        return redirect()->back()->with('error', 'Access denied.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contract $contract)
    {
        if (Auth::user()->position !== 'Manager' && Auth::user()->position !== 'Admin') {
            return redirect()->back()->with('error', 'Access denied.');
        }
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,supplier_id',
            'material_type' => 'required|in:Flour,Salt,Kansui',
            'price' => 'nullable|numeric',
            'delivery_schedule' => 'nullable|string|max:100',
            'contract_duration' => 'nullable|date',
            'payment_status' => 'in:Pending,Paid',
        ]);
        $contract->update($validated);
        return redirect()->route('contracts.index')->with('success', 'Contract updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contract $contract)
    {
        if (Auth::user()->position !== 'Admin') {
            return redirect()->back()->with('error', 'Access denied.');
        }
        $contract->delete();
        return redirect()->route('contracts.index')->with('success', 'Contract deleted.');
    }
}
