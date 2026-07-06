<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\LaporanController;

Route::get('/', function () {
    return view('welcome');
});

// ==========================
// Dashboard (Semua User)
// ==========================
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware('verified')
        ->name('dashboard');

});

// ==========================
// ADMIN
// ==========================
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->group(function () {

        Route::get('/', function () {
            return redirect()->route('dashboard');
        });

        // Master Data
        Route::resource('kategori', KategoriController::class);
        Route::resource('supplier', SupplierController::class);
        Route::resource('gudang', GudangController::class);
        Route::resource('barang', BarangController::class);

        // Transaksi
        Route::resource('barang-masuk', BarangMasukController::class);
        Route::resource('barang-keluar', BarangKeluarController::class);

        // Laporan
        Route::prefix('laporan')->group(function () {

            Route::get('/barang', [LaporanController::class, 'barang'])
                ->name('laporan.barang');

            Route::get('/barang/pdf', [LaporanController::class, 'barangPdf'])
                ->name('laporan.barang.pdf');

            Route::get('/barang-masuk', [LaporanController::class, 'barangMasuk'])
                ->name('laporan.barang-masuk');

            Route::get('/barang-masuk/pdf', [LaporanController::class, 'barangMasukPdf'])
                ->name('laporan.barang-masuk.pdf');

            Route::get('/barang-keluar', [LaporanController::class, 'barangKeluar'])
                ->name('laporan.barang-keluar');

            Route::get('/barang-keluar/pdf', [LaporanController::class, 'barangKeluarPdf'])
                ->name('laporan.barang-keluar.pdf');

        });

});

// ==========================
// MANAJER
// ==========================
Route::middleware(['auth', 'role:manajer'])
    ->prefix('manajer')
    ->name('manajer.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        // View Data Barang
        Route::get('/barang', [BarangController::class, 'index'])
            ->name('barang');

        // Laporan Barang
        Route::get('/laporan/barang', [LaporanController::class, 'barang'])
            ->name('laporan.barang');

        Route::get('/laporan/barang/pdf', [LaporanController::class, 'barangPdf'])
            ->name('laporan.barang.pdf');

        // Laporan Barang Masuk
        Route::get('/laporan/barang-masuk', [LaporanController::class, 'barangMasuk'])
            ->name('laporan.barangMasuk');

        Route::get('/laporan/barang-masuk/pdf', [LaporanController::class, 'barangMasukPdf'])
            ->name('laporan.barangMasuk.pdf');

        // Laporan Barang Keluar
        Route::get('/laporan/barang-keluar', [LaporanController::class, 'barangKeluar'])
            ->name('laporan.barangKeluar');

        Route::get('/laporan/barang-keluar/pdf', [LaporanController::class, 'barangKeluarPdf'])
            ->name('laporan.barangKeluar.pdf');

    });

require __DIR__.'/auth.php';