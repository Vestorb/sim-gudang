@extends('layouts.admin')

@section('title', 'Data Gudang')

@section('content')

<div class="bg-white rounded-lg shadow">

    {{-- Header --}}
    <div class="flex justify-between items-center p-6 border-b">

        <div>

            <h3 class="text-xl font-semibold">
                Data Gudang
            </h3>

            <p class="text-gray-500 text-sm">
                Daftar gudang pada sistem.
            </p>

        </div>

        <a href="{{ route('gudang.create') }}"
            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">

            + Tambah Gudang

        </a>

    </div>

    {{-- Search --}}
    <div class="px-6 py-4 border-b bg-gray-50">

        <form method="GET" action="{{ route('gudang.index') }}">

            <div class="flex gap-3">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari kode atau nama gudang..."
                    class="flex-1 border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">

                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">

                    Cari

                </button>

                <a href="{{ route('gudang.index') }}"
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
                    <th class="px-5 py-3">Nama Gudang</th>
                    <th class="px-5 py-3">Lokasi</th>
                    <th class="px-5 py-3">Keterangan</th>
                    <th class="px-5 py-3 text-center">Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse($gudang as $item)

                <tr class="border-t hover:bg-gray-50">

                    <td class="px-5 py-3">

                        {{ $loop->iteration }}

                    </td>

                    <td class="px-5 py-3">

                        {{ $item->kode_gudang }}

                    </td>

                    <td class="px-5 py-3">

                        {{ $item->nama_gudang }}

                    </td>

                    <td class="px-5 py-3">

                        {{ $item->lokasi }}

                    </td>

                    <td class="px-5 py-3">

                        {{ $item->keterangan }}

                    </td>

                    <td class="px-5 py-3">

                        <div class="flex justify-center gap-2">

                            <a href="{{ route('gudang.edit', $item->id) }}"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">

                                Edit

                            </a>

                            <form
                                id="delete-form-{{ $item->id }}"
                                action="{{ route('gudang.destroy', $item->id) }}"
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

                    <td colspan="6"
                        class="text-center py-8 text-gray-500">

                        Tidak ada data gudang.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection