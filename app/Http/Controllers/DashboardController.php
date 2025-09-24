<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RawMaterialStock;
use App\Models\RawMaterialBatch;
use App\Models\ProductionBatch;
use App\Models\QualityControlResult;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function admin()
    {
        return view('dashboard.admin');
    }

    public function manager()
    {
        // Query stok bahan baku per jenis material
        $stocks = RawMaterialStock::with('rawMaterialBatch')
            ->select('raw_material_batches.material_type', DB::raw('SUM(raw_material_stocks.available_quantity) as total_quantity'), 'raw_material_stocks.unit')
            ->join('raw_material_batches', 'raw_material_stocks.raw_batch_id', '=', 'raw_material_batches.id')
            ->groupBy('raw_material_batches.material_type', 'raw_material_stocks.unit')
            ->get();

        // Query status produksi saat ini (misal: batch dengan status 'In Progress' atau 'In Warehouse')
        $productions = ProductionBatch::whereIn('status', ['In Progress', 'In Warehouse'])
            ->get();

        // Query analisis efisiensi: jumlah batch cacat dan bagian lambat (asumsi dari notes QC)
        $defectiveBatches = QualityControlResult::where('result', 'Tidak')->count();
        $slowProcesses = QualityControlResult::select('action_taken')
            ->whereNotNull('action_taken')
            ->where('action_taken', 'like', '%lambat%')
            ->groupBy('action_taken')
            ->get()
            ->map(function ($item) {
                return $item->action_taken; // Ambil bagian lambat dari catatan
            })->first() ?: 'Tidak ada data';

        // Query pelacakan batch dari bahan ke gudang
        $batchTracking = RawMaterialBatch::select(
            'raw_material_batches.batch_code',
            'raw_material_batches.material_type',
            'raw_material_batches.received_date as received_date',
            'production_batches.production_date',
            'finished_goods_stocks.entry_date as warehouse_date',
            DB::raw('CASE 
                WHEN finished_goods_stocks.entry_date IS NOT NULL THEN "Di Gudang" 
            WHEN production_batches.production_date IS NOT NULL THEN "Diproses" 
                ELSE "Diterima" END as status')
        )
        ->leftJoin('production_materials', 'raw_material_batches.id', '=', 'production_materials.raw_batch_id')
        ->leftJoin('production_batches', 'production_materials.production_id', '=', 'production_batches.id')
        ->leftJoin('finished_goods_stocks', 'production_batches.id', '=', 'finished_goods_stocks.production_id')
        ->groupBy(
            'raw_material_batches.batch_code',
            'raw_material_batches.material_type',
            'raw_material_batches.received_date',
            'production_batches.production_date',
            'finished_goods_stocks.entry_date'
        )
        ->get();

        return view('dashboard.manager', compact('stocks', 'productions', 'defectiveBatches', 'slowProcesses', 'batchTracking'));
    }

    public function staff()
    {
        return view('dashboard.staff');
    }
}
