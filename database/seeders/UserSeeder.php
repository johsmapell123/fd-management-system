<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'department' => null,
            'position' => 'Admin',
        ]);

        User::create([
            'name' => 'Gudang Staff',
            'email' => 'warehouse@example.com',
            'password' => Hash::make('password'),
            'department' => 'Warehouse',
            'position' => 'Staff',
        ]);

        User::create([
            'name' => 'Produksi Staff',
            'email' => 'production@example.com',
            'password' => Hash::make('password'),
            'department' => 'Production',
            'position' => 'Staff',
        ]);

        User::create([
            'name' => 'QC Staff',
            'email' => 'qc@example.com',
            'password' => Hash::make('password'),
            'department' => 'QC',
            'position' => 'Staff',
        ]);

        User::create([
            'name' => 'Produksi Manager',
            'email' => 'manager.production@example.com',
            'password' => Hash::make('password'),
            'department' => 'Production',
            'position' => 'Manager',
        ]);
    }
}
