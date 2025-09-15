<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RawMaterialBatchController;
use App\Http\Controllers\QCController;
use App\Http\Controllers\ProductionBatchController;

Route::get('/', function () {
    return redirect()->route('login');
});


// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// //middleware auth yang sudah login akan diarahkan sesuai role
// Route::middleware('auth')->group(function () {
//     Route::get('/admin/dashboard', function () {
//         return "Halaman Admin";
//     });

//     Route::get('/manager/dashboard', function () {
//         return "Halaman Manager";
//     });

//     Route::get('/staff/dashboard', function () {
//         return "Halaman Staff";
//     });
// });


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

Route::middleware(['auth', 'role:Admin'])->get('/admin/dashboard', function () {
    return view('dashboard.admin');
})->name('admin.dashboard');

Route::middleware(['auth', 'role:Manager'])->get('/manager/dashboard', function () {
    return view('dashboard.manager');
})->name('manager.dashboard');

Route::middleware(['auth', 'role:Staff'])->get('/staff/dashboard', function () {
    return view('dashboard.staff');
})->name('staff.dashboard');



// rioutes for Supplier management (only accessible by Admin)
// Assume you have a SupplierController to handle supplier-related actions
Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/suppliers', [SupplierController::class, 'index'])->name('suppliers.index');
    Route::get('/suppliers/create', [SupplierController::class, 'create'])->name('suppliers.create');
    Route::post('/suppliers', [SupplierController::class, 'store'])->name('suppliers.store');
    Route::post('/suppliers/{id}/toggle-status', [SupplierController::class, 'toggleStatus'])->name('suppliers.toggleStatus');
});

// Routes for User management (only accessible by Admin)
// Route::middleware(['auth', 'role:Admin'])->group(function () {
//     Route::get('/users', [UserController::class, 'index'])->name('users.index');
//     Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
//     Route::post('/users', [UserController::class, 'store'])->name('users.store');
//     Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
// });

Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');

    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');

    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});

// Routes for Raw Material Batch management (accessible by Staff in Warehouse)
Route::middleware(['auth', 'role:Staff'])->group(function () {
    Route::get('/warehouse/raw-materials', [RawMaterialBatchController::class, 'index'])->name('raw_materials.index');
    Route::get('/warehouse/raw-materials/create', [RawMaterialBatchController::class, 'create'])->name('raw_materials.create');
    Route::post('/warehouse/raw-materials', [RawMaterialBatchController::class, 'store'])->name('raw_materials.store');
});

// Routes for Quality Control (accessible by Staff in QC)
Route::middleware(['auth', 'role:Staff'])->group(function () {
    Route::get('/qc/batches', [QCController::class, 'index'])->name('qc.index');
    Route::post('/qc/batches/{id}/approve', [QCController::class, 'approve'])->name('qc.approve');
    Route::post('/qc/batches/{id}/reject', [QCController::class, 'reject'])->name('qc.reject');
});

// Routes for Production Batch management (accessible by Staff in Production)
Route::middleware(['auth', 'role:Staff'])->group(function () {
    Route::get('/production-batches', [ProductionBatchController::class, 'index'])->name('production_batches.index');
    Route::get('/production-batches/create', [ProductionBatchController::class, 'create'])->name('production_batches.create');
    Route::post('/production-batches', [ProductionBatchController::class, 'store'])->name('production_batches.store');
});