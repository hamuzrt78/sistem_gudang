<?php

use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StockInController;
use App\Http\Controllers\StockOutController;
use App\Http\Controllers\StockMutationController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // All authenticated users
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Reports (Viewer, Staff, Superadmin, Pimpinan)
    Route::get('/laporan/stok', [ReportController::class, 'stok'])->name('laporan.stok');
    Route::get('/laporan/masuk', [ReportController::class, 'masuk'])->name('laporan.masuk');
    Route::get('/laporan/keluar', [ReportController::class, 'keluar'])->name('laporan.keluar');
    Route::get('/laporan/mutasi', [StockMutationController::class, 'index'])->name('mutations.index');
    Route::get('/laporan/export-pdf', [ReportController::class, 'exportPdf'])->name('laporan.export.pdf');
    Route::get('/laporan/export-excel', [ReportController::class, 'exportExcel'])->name('laporan.export.excel');

    // Staff and Superadmin: view transaction history
    Route::middleware(['role:superadmin|staff'])->group(function () {
        Route::resource('stock-ins', StockInController::class)->only(['index', 'destroy']);
        Route::resource('stock-outs', StockOutController::class)->only(['index', 'destroy']);
    });

    // Staff ONLY: submit new stock in/out requests
    Route::middleware(['role:staff'])->group(function () {
        Route::get('/stock-ins/create', [StockInController::class, 'create'])->name('stock-ins.create');
        Route::post('/stock-ins', [StockInController::class, 'store'])->name('stock-ins.store');
        
        Route::get('/stock-outs/create', [StockOutController::class, 'create'])->name('stock-outs.create');
        Route::post('/stock-outs', [StockOutController::class, 'store'])->name('stock-outs.store');
    });

    // Superadmin ONLY: Master data + Approval Level 1
    Route::middleware(['role:superadmin'])->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('units', UnitController::class);
        Route::resource('items', ItemController::class);

        // Approval Level 1
        Route::get('/approvals/superadmin', [ApprovalController::class, 'superadminIndex'])->name('approvals.superadmin.index');
        Route::post('/approvals/superadmin/pengajuan/{pengajuan}/approve', [ApprovalController::class, 'superadminApprove'])->name('approvals.superadmin.approve');
        Route::post('/approvals/superadmin/pengajuan/{pengajuan}/reject', [ApprovalController::class, 'superadminReject'])->name('approvals.superadmin.reject');
    });

    // Pimpinan ONLY: Approval Level 2 (Final)
    Route::middleware(['role:pimpinan'])->group(function () {
        Route::get('/approvals/pimpinan', [ApprovalController::class, 'pimpinanIndex'])->name('approvals.pimpinan.index');
        Route::post('/approvals/pimpinan/pengajuan/{pengajuan}/approve', [ApprovalController::class, 'pimpinanApprove'])->name('approvals.pimpinan.approve');
        Route::post('/approvals/pimpinan/pengajuan/{pengajuan}/reject', [ApprovalController::class, 'pimpinanReject'])->name('approvals.pimpinan.reject');
    });
});

require __DIR__.'/auth.php';
