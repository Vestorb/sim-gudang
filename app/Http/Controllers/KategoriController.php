<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;


class KategoriController extends Controller
{
    // Menampilkan daftar kategori
    public function index(Request $request)
{
    $query = Kategori::query();

    if ($request->filled('search')) {

        $query->where(function ($q) use ($request) {

            $q->where('kode_kategori', 'like', '%' . $request->search . '%')
              ->orWhere('nama_kategori', 'like', '%' . $request->search . '%');

        });

    }

    $kategori = $query
        ->latest()
        ->get();

    return view('kategori.index', compact('kategori'));
}

    // Menampilkan form tambah kategori
    public function create()
    {
        return view('kategori.create');
    }

    // Menyimpan data kategori ke database
    public function store(Request $request)
    {
        $request->validate([
            'kode_kategori' => 'required|unique:kategori,kode_kategori|max:20',
            'nama_kategori' => 'required|max:100',
            'deskripsi'     => 'nullable',
        ]);

        Kategori::create([
            'kode_kategori' => $request->kode_kategori,
            'nama_kategori' => $request->nama_kategori,
            'deskripsi'     => $request->deskripsi,
        ]);

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
{
    $kategori = Kategori::findOrFail($id);

    return view('kategori.edit', compact('kategori'));
}

    public function update(Request $request, string $id)
{
    $kategori = Kategori::findOrFail($id);

    $request->validate([
        'kode_kategori' => 'required|max:20|unique:kategori,kode_kategori,' . $kategori->id,
        'nama_kategori' => 'required|max:100',
        'deskripsi'     => 'nullable',
    ]);

    $kategori->update([
        'kode_kategori' => $request->kode_kategori,
        'nama_kategori' => $request->nama_kategori,
        'deskripsi'     => $request->deskripsi,
    ]);

    return redirect()
        ->route('kategori.index')
        ->with('success', 'Kategori berhasil diperbarui.');
}

    public function destroy(string $id)
{
    $kategori = Kategori::findOrFail($id);

    $kategori->delete();

    return redirect()
        ->route('kategori.index')
        ->with('success', 'Kategori berhasil dihapus.');
}
}