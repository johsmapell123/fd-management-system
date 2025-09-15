<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Suppliers
        $supplier1 = DB::table('suppliers')->insertGetId([
            'name' => 'PT Pangan Makmur',
            'contact_person' => 'Budi',
            'phone' => '08123456789',
            'email' => 'budi@pangan.com',
            'address' => 'Jakarta',
            'status' => 'Active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $supplier2 = DB::table('suppliers')->insertGetId([
            'name' => 'PT Garam Sejahtera',
            'contact_person' => 'Sari',
            'phone' => '08129876543',
            'email' => 'sari@garam.com',
            'address' => 'Surabaya',
            'status' => 'Active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $supplier3 = DB::table('suppliers')->insertGetId([
            'name' => 'PT Kansui Indo',
            'contact_person' => 'Andi',
            'phone' => '08567891234',
            'email' => 'andi@kansui.com',
            'address' => 'Bandung',
            'status' => 'Active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Raw Material Batches
        $batch1 = DB::table('raw_material_batches')->insertGetId([
            'batch_code' => 'PM-' . Carbon::now()->format('ymd') . '-01',
            'supplier_id' => $supplier1,
            'material_type' => 'Flour',
            'received_date' => Carbon::today(),
            'quantity' => 1000,
            'unit' => 'kg',
            'status' => 'OK',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $batch2 = DB::table('raw_material_batches')->insertGetId([
            'batch_code' => 'GS-' . Carbon::now()->format('ymd') . '-01',
            'supplier_id' => $supplier2,
            'material_type' => 'Salt',
            'received_date' => Carbon::today(),
            'quantity' => 200,
            'unit' => 'kg',
            'status' => 'OK',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Warehouses
        $whRaw = DB::table('warehouses')->insertGetId([
            'name' => 'Gudang Bahan Baku',
            'type' => 'RawMaterial',
            'location' => 'Jakarta',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $whFinished = DB::table('warehouses')->insertGetId([
            'name' => 'Gudang Produk Jadi',
            'type' => 'FinishedGoods',
            'location' => 'Jakarta',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Raw Material Stock
        DB::table('raw_material_stocks')->insert([
            'raw_batch_id' => $batch1,
            'warehouse_id' => $whRaw,
            'available_quantity' => 1000,
            'unit' => 'kg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('raw_material_stocks')->insert([
            'raw_batch_id' => $batch2,
            'warehouse_id' => $whRaw,
            'available_quantity' => 200,
            'unit' => 'kg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Production Batch
        $prod1 = DB::table('production_batches')->insertGetId([
            'production_code' => 'RSN-' . Carbon::now()->format('ymd') . '-A',
            'production_date' => Carbon::today(),
            'shift' => 'A',
            'quantity_carton' => 500,
            'status' => 'In Warehouse',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Production Materials (pakai Flour 500kg + Salt 50kg)
        DB::table('production_materials')->insert([
            'production_id' => $prod1,
            'raw_batch_id' => $batch1,
            'quantity_used' => 500,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('production_materials')->insert([
            'production_id' => $prod1,
            'raw_batch_id' => $batch2,
    
            'quantity_used' => 50,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Finished Goods Stock
        DB::table('finished_goods_stocks')->insert([
            'production_id' => $prod1,
            'warehouse_id' => $whFinished,
            'available_carton' => 500,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
