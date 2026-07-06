@extends('layouts.admin')

@section('title', 'Data Kategori')

@section('content')

<div class="bg-white rounded-lg shadow">

    {{-- Header --}}
    <div class="flex justify-between items-center p-6 border-b">

        <div>

            <h3 class="text-xl font-semibold">
                Data Kategori
            </h3>

            <p class="text-gray-500 text-sm">
                Daftar kategori barang pada sistem.
            </p>

        </div>

        <a href="{{ route('kategori.create') }}"
            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">

            + Tambah Kategori

        </a>

    </div>

    {{-- Search --}}
    <div class="px-6 py-4 border-b bg-gray-50">

        <form method="GET" action="{{ route('kategori.index') }}">

            <div class="flex gap-3">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari kode atau nama kategori..."
                    class="flex-1 border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">

                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">

                    Cari

                </button>

                <a href="{{ route('kategori.index') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg">

                    Reset

                </a>

            </div>

        </form>

    </div>

    {{-- Tabel --}}
    <div class="overflow-x-auto">

        <table class="min-w-full">

            <thead class="bg-gray-100">

                <tr>

                    <th class="px-5 py-3">No</th>
                    <th class="px-5 py-3">Kode</th>
                    <th class="px-5 py-3">Nama Kategori</th>
                    <th class="px-5 py-3">Deskripsi</th>
                    <th class="px-5 py-3 text-center">Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse($kategori as $item)

                <tr class="border-t hover:bg-gray-50">

                    <td class="px-5 py-3">
                        {{ $loop->iteration }}
                    </td>

                    <td class="px-5 py-3">
                        {{ $item->kode_kategori }}
                    </td>

                    <td class="px-5 py-3">
                        {{ $item->nama_kategori }}
                    </td>

                    <td class="px-5 py-3">
                        {{ $item->deskripsi }}
                    </td>

                    <td class="px-5 py-3">

                        <div class="flex justify-center gap-2">

                            {{-- Edit --}}
                            <a href="{{ route('kategori.edit', $item->id) }}"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">

                                Edit

                            </a>

                            {{-- Hapus --}}
                            <form
                                id="delete-form-{{ $item->id }}"
                                action="{{ route('kategori.destroy', $item->id) }}"
                                method="POST">

                                @csrf
                                @method('DELETE')

                                <button
                                    type="button"
                                    onclick="confirmDelete('delete-form-{{ $item->id }}')"
                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">

                                    Hapus

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="5"
                        class="text-center py-8 text-gray-500">

                        Tidak ada data kategori.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection