<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RawMaterialBatch;

class QCController extends Controller
{
    public function index()
    {
        // ambil semua batch bahan baku
        $batches = RawMaterialBatch::with('supplier')->latest()->get();
        return view('qc.batches.index', compact('batches'));
    }

    public function approve($id)
    {
        $batch = RawMaterialBatch::findOrFail($id);
        $batch->status = 'In Use'; // artinya sudah siap dipakai
        $batch->save();

        return redirect()->route('qc.index')->with('success', "Batch {$batch->batch_code} berhasil di-approve.");
    }

    public function reject($id)
    {
        $batch = RawMaterialBatch::findOrFail($id);
        $batch->status = 'Rejected'; // ditolak
        $batch->save();

        return redirect()->route('qc.index')->with('error', "Batch {$batch->batch_code} ditolak.");
    }
}
