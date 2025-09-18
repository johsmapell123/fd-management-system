<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\RawMaterialBatchController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\RawMaterialStockController;
use App\Http\Controllers\ProductionBatchController;
use App\Http\Controllers\ProductionMaterialController;
use App\Http\Controllers\FinishedGoodsStockController;
use App\Http\Controllers\QualityControlResultController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Middleware auth yang sudah login akan diarahkan sesuai posisi/role
Route::middleware('auth')->group(function () {   
    // Logout          
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout'); 

    // Route Admin-Only
    Route::middleware('role:Admin')->group(function () {            
        Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('dashboard.admin');

        Route::resource('users', UserController::class);
        Route::resource('suppliers', SupplierController::class);
        Route::resource('contracts', ContractController::class);
        Route::resource('raw-material-batches', RawMaterialBatchController::class);
        Route::resource('warehouses', WarehouseController::class);
        Route::resource('raw-material-stocks', RawMaterialStockController::class);
        Route::resource('production-batches', ProductionBatchController::class);
        Route::resource('production-materials', ProductionMaterialController::class);
        Route::resource('finished-goods-stocks', FinishedGoodsStockController::class);
        Route::resource('quality-control-results', QualityControlResultController::class);

        // Route::get('/users', [UserController::class, 'index'])->name('users.index');
        // Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        // Route::post('/users', [UserController::class, 'store'])->name('users.store');

        // Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        // Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');

        // Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

        // Route::get('/suppliers', [SupplierController::class, 'index'])->name('suppliers.index');
        // Route::get('/suppliers/create', [SupplierController::class, 'create'])->name('suppliers.create');
        // Route::post('/suppliers', [SupplierController::class, 'store'])->name('suppliers.store');
        // Route::post('/suppliers/{id}/toggle-status', [SupplierController::class, 'toggleStatus'])->name('suppliers.toggleStatus');
    });

    // Route Manager-Only
    Route::middleware('role:Manager')->group(function () {
        Route::get('/manager/dashboard', [DashboardController::class, 'manager'])->name('dashboard.manager');

        Route::resource('suppliers', SupplierController::class)->only(['index', 'show', 'edit', 'update']); // Validasi supplier
        Route::resource('contracts', ContractController::class)->only(['index', 'show', 'edit', 'update']); // Validasi kontrak
        Route::resource('raw-material-batches', RawMaterialBatchController::class)->only(['index', 'show', 'edit', 'update']); // Approve QC bahan
        Route::resource('production-batches', ProductionBatchController::class)->only(['index', 'show', 'edit', 'update']); // Validasi produksi selesai
        Route::resource('quality-control-results', QualityControlResultController::class)->only(['index', 'show', 'edit', 'update']); // Approve QC produk
        Route::resource('raw-material-stocks', RawMaterialStockController::class)->only(['index', 'update']); // Lihat & adjust stok bahan
        Route::resource('finished-goods-stocks', FinishedGoodsStockController::class)->only(['index', 'update']); // Lihat & adjust stok jadi
    }); 

    // Route Staff-Only
    Route::middleware('role:Staff')->group(function () {
        Route::get('/staff/dashboard', [DashboardController::class, 'staff'])->name('dashboard.staff');

        Route::resource('raw-material-batches', RawMaterialBatchController::class)->only(['create', 'store']); // Input penerimaan bahan
        Route::resource('production-batches', ProductionBatchController::class)->only(['create', 'store']); // Mulai produksi
        Route::resource('finished-goods-stocks', FinishedGoodsStockController::class)->only(['create', 'store']); // Terima produk jadi
        Route::resource('production-materials', ProductionMaterialController::class)->only(['store']); // Tambah bahan ke produksi
        Route::resource('quality-control-results', QualityControlResultController::class)->only(['create', 'store']); // Input hasil QC awal

        // // Routes for Raw Material Batch management (accessible by Staff in Warehouse)
        // Route::get('/warehouse/raw-materials', [RawMaterialBatchController::class, 'index'])->name('raw_materials.index');
        // Route::get('/warehouse/raw-materials/create', [RawMaterialBatchController::class, 'create'])->name('raw_materials.create');
        // Route::post('/warehouse/raw-materials', [RawMaterialBatchController::class, 'store'])->name('raw_materials.store');

        // // Routes for Quality Control (accessible by Staff in QC)
        // Route::get('/qc/batches', [QCController::class, 'index'])->name('qc.index');
        // Route::post('/qc/batches/{id}/approve', [QCController::class, 'approve'])->name('qc.approve');
        // Route::post('/qc/batches/{id}/reject', [QCController::class, 'reject'])->name('qc.reject');

        // // Routes for Production Batch management (accessible by Staff in Production)
        // Route::get('/production-batches', [ProductionBatchController::class, 'index'])->name('production_batches.index');
        // Route::get('/production-batches/create', [ProductionBatchController::class, 'create'])->name('production_batches.create');
        // Route::post('/production-batches', [ProductionBatchController::class, 'store'])->name('production_batches.store');
    });
});

// Route::middleware(['auth', 'role:Admin'])->get('/admin/dashboard', function () {
//     return view('dashboard.admin');
// })->name('admin.dashboard');

// Route::middleware(['auth', 'role:Manager'])->get('/manager/dashboard', function () {
//     return view('dashboard.manager');
// })->name('manager.dashboard');

// Route::middleware(['auth', 'role:Staff'])->get('/staff/dashboard', function () {
//     return view('dashboard.staff');
// })->name('staff.dashboard');


// // Authentication Routes
// Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [AuthController::class, 'login']);
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard (hanya contoh)
// Route::middleware('auth')->group(function () {
//     Route::get('/admin/dashboard', fn() => "Admin Dashboard");
//     Route::get('/manager/dashboard', fn() => "Manager Dashboard");
//     Route::get('/staff/dashboard', fn() => "Staff Dashboard");
// });
// Middleware untuk role-based access control
// Route::middleware(['auth', 'role:Admin'])->get('/admin/dashboard', function () {
//     return "Admin Dashboard";
// });

// Route::middleware(['auth', 'role:Manager'])->get('/manager/dashboard', function () {
//     return "Manager Dashboard";
// });

// Route::middleware(['auth', 'role:Staff'])->get('/staff/dashboard', function () {
//     return "Staff Dashboard";
// });

// rioutes for Supplier management (only accessible by Admin)
// Assume you have a SupplierController to handle supplier-related actions
// Route::middleware(['auth', 'role:Admin'])->group(function () {
    // Route::get('/suppliers', [SupplierController::class, 'index'])->name('suppliers.index');
    // Route::get('/suppliers/create', [SupplierController::class, 'create'])->name('suppliers.create');
    // Route::post('/suppliers', [SupplierController::class, 'store'])->name('suppliers.store');
    // Route::post('/suppliers/{id}/toggle-status', [SupplierController::class, 'toggleStatus'])->name('suppliers.toggleStatus');
// });

// Routes for User management (only accessible by Admin)
// Route::middleware(['auth', 'role:Admin'])->group(function () {
//     Route::get('/users', [UserController::class, 'index'])->name('users.index');
//     Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
//     Route::post('/users', [UserController::class, 'store'])->name('users.store');
//     Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
// });

// Route::middleware(['auth', 'role:Admin'])->group(function () {

// });

// Routes for Raw Material Batch management (accessible by Staff in Warehouse)
// Route::middleware(['auth', 'role:Staff'])->group(function () {

// });

// Routes for Quality Control (accessible by Staff in QC)
// Route::middleware(['auth', 'role:Staff'])->group(function () {

// });

// Routes for Production Batch management (accessible by Staff in Production)
// Route::middleware(['auth', 'role:Staff'])->group(function () {

// });