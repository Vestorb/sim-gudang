<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Gudang;
use App\Models\Supplier;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // =========================
        // KPI
        // =========================

        $totalBarang = Barang::count();

        $totalGudang = Gudang::count();

        $totalSupplier = Supplier::count();

        $stokMenipis = Barang::whereColumn(
            'stok',
            '<=',
            'stok_minimum'
        )->count();

        $totalBarangMasuk = BarangMasuk::count();

        $totalBarangKeluar = BarangKeluar::count();

        // =========================
        // Grafik Barang Masuk
        // =========================

        $barangMasukChart = BarangMasuk::select(
                DB::raw('MONTH(tanggal) as bulan'),
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        // =========================
        // Grafik Barang Keluar
        // =========================

        $barangKeluarChart = BarangKeluar::select(
                DB::raw('MONTH(tanggal) as bulan'),
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        return view('dashboard', compact(
            'totalBarang',
            'totalGudang',
            'totalSupplier',
            'stokMenipis',
            'totalBarangMasuk',
            'totalBarangKeluar',
            'barangMasukChart',
            'barangKeluarChart'
        ));
    }
}