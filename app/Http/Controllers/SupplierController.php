<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index(Request $request)
{
    $query = Supplier::query();

    if ($request->filled('search')) {

        $query->where(function ($q) use ($request) {

            $q->where('kode_supplier', 'like', '%' . $request->search . '%')
              ->orWhere('nama_supplier', 'like', '%' . $request->search . '%');

        });

    }

    $supplier = $query
        ->latest()
        ->get();

    return view('supplier.index', compact('supplier'));
}

    public function create()
    {
        return view('supplier.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_supplier' => 'required|max:20|unique:supplier,kode_supplier',
            'nama_supplier' => 'required|max:100',
            'alamat'        => 'nullable',
            'telepon'       => 'nullable|max:20',
            'email'         => 'nullable|email',
        ]);

        Supplier::create([
            'kode_supplier' => $request->kode_supplier,
            'nama_supplier' => $request->nama_supplier,
            'alamat'        => $request->alamat,
            'telepon'       => $request->telepon,
            'email'         => $request->email,
        ]);

        return redirect()
            ->route('supplier.index')
            ->with('success', 'Supplier berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $supplier = Supplier::findOrFail($id);

        return view('supplier.edit', compact('supplier'));
    }

    public function update(Request $request, string $id)
    {
        $supplier = Supplier::findOrFail($id);

        $request->validate([
            'kode_supplier' => 'required|max:20|unique:supplier,kode_supplier,' . $supplier->id,
            'nama_supplier' => 'required|max:100',
            'alamat'        => 'nullable',
            'telepon'       => 'nullable|max:20',
            'email'         => 'nullable|email',
        ]);

        $supplier->update([
            'kode_supplier' => $request->kode_supplier,
            'nama_supplier' => $request->nama_supplier,
            'alamat'        => $request->alamat,
            'telepon'       => $request->telepon,
            'email'         => $request->email,
        ]);

        return redirect()
            ->route('supplier.index')
            ->with('success', 'Supplier berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $supplier = Supplier::findOrFail($id);

        $supplier->delete();

        return redirect()
            ->route('supplier.index')
            ->with('success', 'Supplier berhasil dihapus.');
    }
}