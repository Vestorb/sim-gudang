<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use Illuminate\Http\Request;

class GudangController extends Controller
{
    public function index(Request $request)
{
    $query = Gudang::query();

    if ($request->filled('search')) {

        $query->where(function ($q) use ($request) {

            $q->where('kode_gudang', 'like', '%' . $request->search . '%')
              ->orWhere('nama_gudang', 'like', '%' . $request->search . '%');

        });

    }

    $gudang = $query
        ->latest()
        ->get();

    return view('gudang.index', compact('gudang'));
}

    public function create()
    {
        return view('gudang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_gudang' => 'required|max:20|unique:gudang,kode_gudang',
            'nama_gudang' => 'required|max:100',
            'lokasi'      => 'required',
            'kapasitas'   => 'required|integer|min:0',
            'keterangan'  => 'nullable',
        ]);

        Gudang::create($request->all());

        return redirect()
            ->route('gudang.index')
            ->with('success', 'Gudang berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $gudang = Gudang::findOrFail($id);

        return view('gudang.edit', compact('gudang'));
    }

    public function update(Request $request, string $id)
    {
        $gudang = Gudang::findOrFail($id);

        $request->validate([
            'kode_gudang' => 'required|max:20|unique:gudang,kode_gudang,' . $gudang->id,
            'nama_gudang' => 'required|max:100',
            'lokasi'      => 'required',
            'kapasitas'   => 'required|integer|min:0',
            'keterangan'  => 'nullable',
        ]);

        $gudang->update($request->all());

        return redirect()
            ->route('gudang.index')
            ->with('success', 'Gudang berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $gudang = Gudang::findOrFail($id);

        $gudang->delete();

        return redirect()
            ->route('gudang.index')
            ->with('success', 'Gudang berhasil dihapus.');
    }
}