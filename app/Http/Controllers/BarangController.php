<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Supplier;
use App\Models\Gudang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
 * Display a listing of the resource.
 */
public function index(Request $request)
{
    $query = Barang::with([
        'kategori',
        'supplier',
        'gudang'
    ]);

    if ($request->filled('search')) {

        $query->where(function ($q) use ($request) {

            $q->where('kode_barang', 'like', '%' . $request->search . '%')
              ->orWhere('nama_barang', 'like', '%' . $request->search . '%');

        });

    }

    $barang = $query
        ->latest()
        ->get();

    return view('barang.index', compact('barang'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori::orderBy('nama_kategori')->get();
        $supplier = Supplier::orderBy('nama_supplier')->get();
        $gudang = Gudang::orderBy('nama_gudang')->get();

        return view('barang.create', compact(
            'kategori',
            'supplier',
            'gudang'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_barang'  => 'required|max:20|unique:barang,kode_barang',
            'nama_barang'  => 'required|max:150',
            'kategori_id'  => 'required|exists:kategori,id',
            'supplier_id'  => 'required|exists:supplier,id',
            'gudang_id'    => 'required|exists:gudang,id',
            'stok_minimum' => 'required|integer|min:0',
            'satuan'       => 'required|max:30',
            'harga'        => 'required|numeric|min:0',
            'status'       => 'required|in:Aktif,Nonaktif',
            'deskripsi'    => 'nullable',
        ]);

        $data = [
            'kode_barang'  => $request->kode_barang,
            'nama_barang'  => $request->nama_barang,
            'kategori_id'  => $request->kategori_id,
            'supplier_id'  => $request->supplier_id,
            'gudang_id'    => $request->gudang_id,
            'stok'         => 0, // stok otomatis
            'stok_minimum' => $request->stok_minimum,
            'satuan'       => $request->satuan,
            'harga'        => $request->harga,
            'status'       => $request->status,
            'deskripsi'    => $request->deskripsi,
        ];

        Barang::create($data);

        return redirect()
            ->route('barang.index')
            ->with('success', 'Barang berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $barang = Barang::findOrFail($id);

        $kategori = Kategori::orderBy('nama_kategori')->get();
        $supplier = Supplier::orderBy('nama_supplier')->get();
        $gudang = Gudang::orderBy('nama_gudang')->get();

        return view('barang.edit', compact(
            'barang',
            'kategori',
            'supplier',
            'gudang'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $barang = Barang::findOrFail($id);

        $request->validate([
            'kode_barang'  => 'required|max:20|unique:barang,kode_barang,' . $barang->id,
            'nama_barang'  => 'required|max:150',
            'kategori_id'  => 'required|exists:kategori,id',
            'supplier_id'  => 'required|exists:supplier,id',
            'gudang_id'    => 'required|exists:gudang,id',
            'stok_minimum' => 'required|integer|min:0',
            'satuan'       => 'required|max:30',
            'harga'        => 'required|numeric|min:0',
            'status'       => 'required|in:Aktif,Nonaktif',
            'deskripsi'    => 'nullable',
        ]);

        $barang->update([
            'kode_barang'  => $request->kode_barang,
            'nama_barang'  => $request->nama_barang,
            'kategori_id'  => $request->kategori_id,
            'supplier_id'  => $request->supplier_id,
            'gudang_id'    => $request->gudang_id,
            'stok_minimum' => $request->stok_minimum,
            'satuan'       => $request->satuan,
            'harga'        => $request->harga,
            'status'       => $request->status,
            'deskripsi'    => $request->deskripsi,
        ]);

        return redirect()
            ->route('barang.index')
            ->with('success', 'Barang berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $barang = Barang::findOrFail($id);

        $barang->delete();

        return redirect()
            ->route('barang.index')
            ->with('success', 'Barang berhasil dihapus.');
    }
}