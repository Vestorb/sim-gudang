<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\DetailBarangKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BarangKeluarController extends Controller
{
    public function index(Request $request)
    {
        $query = BarangKeluar::with([
            'user',
            'detailBarangKeluar.barang'
        ]);

        // Search Nomor Transaksi
        if ($request->filled('search')) {

            $query->where(
                'nomor_transaksi',
                'like',
                '%' . $request->search . '%'
            );

        }

        // Filter Tanggal
        if ($request->filled('tanggal')) {

            $query->whereDate(
                'tanggal',
                $request->tanggal
            );

        }

        $barangKeluar = $query
            ->latest()
            ->get();

        return view(
            'barang_keluar.index',
            compact('barangKeluar')
        );
    }

    public function create()
    {
        $barang = Barang::where('status', 'Aktif')
            ->orderBy('nama_barang')
            ->get();

        return view('barang_keluar.create', compact('barang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_transaksi' => 'required|max:30|unique:barang_keluar,nomor_transaksi',
            'tanggal'         => 'required|date',
            'barang_id'       => 'required|exists:barang,id',
            'jumlah'          => 'required|integer|min:1',
            'harga_jual'      => 'required|numeric|min:0',
            'tujuan'          => 'required|max:150',
            'status'          => 'required|in:Draft,Selesai,Dibatalkan',
            'keterangan'      => 'nullable',
        ]);

        $barang = Barang::findOrFail($request->barang_id);

        if (
            $request->status == 'Selesai'
            && $request->jumlah > $barang->stok
        ) {
            return back()
                ->withInput()
                ->with('error', 'Stok barang tidak mencukupi.');
        }

        DB::transaction(function () use ($request, $barang) {

            $transaksi = BarangKeluar::create([
                'nomor_transaksi' => $request->nomor_transaksi,
                'tanggal'         => $request->tanggal,
                'user_id'         => Auth::id(),
                'tujuan'          => $request->tujuan,
                'status'          => $request->status,
                'keterangan'      => $request->keterangan,
            ]);

            DetailBarangKeluar::create([
                'barang_keluar_id' => $transaksi->id,
                'barang_id'        => $request->barang_id,
                'jumlah'           => $request->jumlah,
                'harga_jual'       => $request->harga_jual,
                'subtotal'         => $request->jumlah * $request->harga_jual,
            ]);

            if ($request->status == 'Selesai') {

                $barang->decrement(
                    'stok',
                    $request->jumlah
                );

            }

        });

        return redirect()
            ->route('barang-keluar.index')
            ->with(
                'success',
                'Transaksi barang keluar berhasil ditambahkan.'
            );
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $barangKeluar = BarangKeluar::with(
            'detailBarangKeluar'
        )->findOrFail($id);

        $detail = $barangKeluar
            ->detailBarangKeluar
            ->first();

        $barang = Barang::where(
            'status',
            'Aktif'
        )
        ->orderBy('nama_barang')
        ->get();

        return view(
            'barang_keluar.edit',
            compact(
                'barangKeluar',
                'detail',
                'barang'
            )
        );
    }

    public function update(
        Request $request,
        string $id
    ) {
        $barangKeluar = BarangKeluar::findOrFail($id);

        $detail = DetailBarangKeluar::where(
            'barang_keluar_id',
            $barangKeluar->id
        )->first();

        $request->validate([
            'nomor_transaksi' => 'required|max:30|unique:barang_keluar,nomor_transaksi,' . $barangKeluar->id,
            'tanggal'         => 'required|date',
            'barang_id'       => 'required|exists:barang,id',
            'jumlah'          => 'required|integer|min:1',
            'harga_jual'      => 'required|numeric|min:0',
            'tujuan'          => 'required|max:150',
            'status'          => 'required|in:Draft,Selesai,Dibatalkan',
            'keterangan'      => 'nullable',
        ]);

        DB::transaction(function () use (
            $request,
            $barangKeluar,
            $detail
        ) {

            if ($barangKeluar->status == 'Selesai') {

                $barangLama = Barang::findOrFail(
                    $detail->barang_id
                );

                $barangLama->increment(
                    'stok',
                    $detail->jumlah
                );
            }

            $barangBaru = Barang::findOrFail(
                $request->barang_id
            );

            if (
                $request->status == 'Selesai'
                && $request->jumlah > $barangBaru->stok
            ) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'jumlah' => 'Stok barang tidak mencukupi.'
                ]);
            }

            $barangKeluar->update([
                'nomor_transaksi' => $request->nomor_transaksi,
                'tanggal'         => $request->tanggal,
                'tujuan'          => $request->tujuan,
                'status'          => $request->status,
                'keterangan'      => $request->keterangan,
            ]);

            $detail->update([
                'barang_id'  => $request->barang_id,
                'jumlah'     => $request->jumlah,
                'harga_jual' => $request->harga_jual,
                'subtotal'   => $request->jumlah * $request->harga_jual,
            ]);

            if ($request->status == 'Selesai') {

                $barangBaru->decrement(
                    'stok',
                    $request->jumlah
                );

            }

        });

        return redirect()
            ->route('barang-keluar.index')
            ->with(
                'success',
                'Transaksi barang keluar berhasil diperbarui.'
            );
    }

    public function destroy(string $id)
    {
        $barangKeluar = BarangKeluar::with(
            'detailBarangKeluar'
        )->findOrFail($id);

        DB::transaction(function () use (
            $barangKeluar
        ) {

            $detail = $barangKeluar
                ->detailBarangKeluar
                ->first();

            if (
                $barangKeluar->status == 'Selesai'
                && $detail
            ) {

                $barang = Barang::findOrFail(
                    $detail->barang_id
                );

                $barang->increment(
                    'stok',
                    $detail->jumlah
                );
            }

            $barangKeluar->delete();

        });

        return redirect()
            ->route('barang-keluar.index')
            ->with(
                'success',
                'Transaksi barang keluar berhasil dihapus.'
            );
    }
}