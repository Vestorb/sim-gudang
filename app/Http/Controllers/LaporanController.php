<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * ===========================
     * LAPORAN BARANG
     * ===========================
     */
    public function barang()
    {
        $barang = Barang::with([
            'kategori',
            'supplier',
            'gudang'
        ])
        ->orderBy('nama_barang')
        ->get();

        return view('laporan.barang', compact('barang'));
    }

    /**
     * Export PDF Laporan Barang
     */
    public function barangPdf()
    {
        $barang = Barang::with([
            'kategori',
            'supplier',
            'gudang'
        ])
        ->orderBy('nama_barang')
        ->get();

        $pdf = Pdf::loadView('laporan.barang_pdf', compact('barang'));

        $pdf->setPaper('A4', 'landscape');

        return $pdf->download('laporan_barang.pdf');
    }

    /**
     * ===========================
     * LAPORAN BARANG MASUK
     * ===========================
     */
    public function barangMasuk(Request $request)
    {
        $query = BarangMasuk::with([
            'supplier',
            'user',
            'detailBarangMasuk.barang'
        ]);

        if ($request->tanggal_awal && $request->tanggal_akhir) {

            $query->whereBetween('tanggal', [
                $request->tanggal_awal,
                $request->tanggal_akhir
            ]);
        }

        $barangMasuk = $query
            ->orderBy('tanggal', 'desc')
            ->get();

        return view(
            'laporan.barang_masuk',
            compact('barangMasuk')
        );
    }

    /**
     * Export PDF Barang Masuk
     */
    public function barangMasukPdf(Request $request)
{
    $query = BarangMasuk::with([
        'supplier',
        'user',
        'detailBarangMasuk.barang'
    ]);

    if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {

        $query->whereBetween('tanggal', [
            $request->tanggal_awal,
            $request->tanggal_akhir
        ]);
    }

    $barangMasuk = $query
        ->orderBy('tanggal', 'desc')
        ->get();

    $pdf = Pdf::loadView(
        'laporan.barang_masuk_pdf',
        compact('barangMasuk')
    );

    $pdf->setPaper('A4', 'landscape');

    return $pdf->download('laporan_barang_masuk.pdf');
}

/**
 * ===========================
 * LAPORAN BARANG KELUAR
 * ===========================
 */
public function barangKeluar(Request $request)
{
    $query = BarangKeluar::with([
        'user',
        'detailBarangKeluar.barang'
    ]);

    if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {

        $query->whereBetween('tanggal', [
            $request->tanggal_awal,
            $request->tanggal_akhir
        ]);
    }

    $barangKeluar = $query
        ->orderBy('tanggal', 'desc')
        ->get();

    return view(
        'laporan.barang_keluar',
        compact('barangKeluar')
    );
}

/**
 * Export PDF Barang Keluar
 */
public function barangKeluarPdf(Request $request)
{
    $query = BarangKeluar::with([
        'user',
        'detailBarangKeluar.barang'
    ]);

    if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {

        $query->whereBetween('tanggal', [
            $request->tanggal_awal,
            $request->tanggal_akhir
        ]);
    }

    $barangKeluar = $query
        ->orderBy('tanggal', 'desc')
        ->get();

    $pdf = Pdf::loadView(
        'laporan.barang_keluar_pdf',
        compact('barangKeluar')
    );

    $pdf->setPaper('A4', 'landscape');

    return $pdf->download('laporan_barang_keluar.pdf');
}
}