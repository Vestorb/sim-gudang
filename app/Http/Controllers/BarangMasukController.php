<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\DetailBarangMasuk;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BarangMasukController extends Controller
{
    public function index(Request $request)
{
    $query = BarangMasuk::with([
        'supplier',
        'user'
    ]);

    // Search Nomor Transaksi
    if ($request->filled('search')) {

        $query->where('nomor_transaksi', 'like', '%' . $request->search . '%');

    }

    // Filter Tanggal
    if ($request->filled('tanggal')) {

        $query->whereDate('tanggal', $request->tanggal);

    }

    $barangMasuk = $query
        ->latest()
        ->get();

    return view('barang_masuk.index', compact('barangMasuk'));
}

    public function create()
    {
        $supplier = Supplier::orderBy('nama_supplier')->get();

        $barang = Barang::where('status', 'Aktif')
            ->orderBy('nama_barang')
            ->get();

        return view('barang_masuk.create', compact(
            'supplier',
            'barang'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_transaksi' => 'required|max:30|unique:barang_masuk,nomor_transaksi',
            'tanggal'         => 'required|date',
            'supplier_id'     => 'required|exists:supplier,id',
            'barang_id'       => 'required|exists:barang,id',
            'jumlah'          => 'required|integer|min:1',
            'harga_beli'      => 'required|numeric|min:0',
            'status'          => 'required|in:Draft,Selesai,Dibatalkan',
            'keterangan'      => 'nullable',
        ]);

        DB::transaction(function () use ($request) {

            $transaksi = BarangMasuk::create([
                'nomor_transaksi' => $request->nomor_transaksi,
                'tanggal'         => $request->tanggal,
                'supplier_id'     => $request->supplier_id,
                'user_id'         => Auth::id(),
                'status'          => $request->status,
                'keterangan'      => $request->keterangan,
            ]);

            DetailBarangMasuk::create([
                'barang_masuk_id' => $transaksi->id,
                'barang_id'       => $request->barang_id,
                'jumlah'          => $request->jumlah,
                'harga_beli'      => $request->harga_beli,
                'subtotal'        => $request->jumlah * $request->harga_beli,
            ]);

            if ($request->status == 'Selesai') {

                $barang = Barang::findOrFail($request->barang_id);

                $barang->increment('stok', $request->jumlah);

            }

        });

        return redirect()
            ->route('barang-masuk.index')
            ->with('success', 'Transaksi barang masuk berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $barangMasuk = BarangMasuk::with('detailBarangMasuk')
            ->findOrFail($id);

        $detail = $barangMasuk->detailBarangMasuk->first();

        $supplier = Supplier::orderBy('nama_supplier')->get();

        $barang = Barang::where('status', 'Aktif')
            ->orderBy('nama_barang')
            ->get();

        return view(
            'barang_masuk.edit',
            compact(
                'barangMasuk',
                'detail',
                'supplier',
                'barang'
            )
        );
    }

    public function update(Request $request, string $id)
    {
        $barangMasuk = BarangMasuk::findOrFail($id);

        $detail = DetailBarangMasuk::where('barang_masuk_id', $barangMasuk->id)
            ->first();

        $request->validate([
            'nomor_transaksi' => 'required|max:30|unique:barang_masuk,nomor_transaksi,' . $barangMasuk->id,
            'tanggal'         => 'required|date',
            'supplier_id'     => 'required|exists:supplier,id',
            'barang_id'       => 'required|exists:barang,id',
            'jumlah'          => 'required|integer|min:1',
            'harga_beli'      => 'required|numeric|min:0',
            'status'          => 'required|in:Draft,Selesai,Dibatalkan',
            'keterangan'      => 'nullable',
        ]);

        DB::transaction(function () use ($request, $barangMasuk, $detail) {

            if ($barangMasuk->status == 'Selesai') {

                $barangLama = Barang::findOrFail($detail->barang_id);

                $barangLama->decrement('stok', $detail->jumlah);

            }

            $barangMasuk->update([
                'nomor_transaksi' => $request->nomor_transaksi,
                'tanggal'         => $request->tanggal,
                'supplier_id'     => $request->supplier_id,
                'status'          => $request->status,
                'keterangan'      => $request->keterangan,
            ]);

            $detail->update([
                'barang_id'  => $request->barang_id,
                'jumlah'     => $request->jumlah,
                'harga_beli' => $request->harga_beli,
                'subtotal'   => $request->jumlah * $request->harga_beli,
            ]);

            if ($request->status == 'Selesai') {

                $barangBaru = Barang::findOrFail($request->barang_id);

                $barangBaru->increment('stok', $request->jumlah);

            }

        });

        return redirect()
            ->route('barang-masuk.index')
            ->with('success', 'Transaksi barang masuk berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $barangMasuk = BarangMasuk::with('detailBarangMasuk')
            ->findOrFail($id);

        DB::transaction(function () use ($barangMasuk) {

            $detail = $barangMasuk->detailBarangMasuk->first();

            if ($barangMasuk->status == 'Selesai' && $detail) {

                $barang = Barang::findOrFail($detail->barang_id);

                $barang->decrement('stok', $detail->jumlah);

            }

            $barangMasuk->delete();

        });

        return redirect()
            ->route('barang-masuk.index')
            ->with('success', 'Transaksi barang masuk berhasil dihapus.');
    }
}