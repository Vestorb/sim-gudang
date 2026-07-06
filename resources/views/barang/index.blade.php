@extends('layouts.admin')

@section('title', 'Data Barang')

@section('content')

<div class="bg-white rounded-lg shadow">

    <div class="flex justify-between items-center p-6 border-b">

        <div>

            <h3 class="text-xl font-semibold">
                Data Barang
            </h3>

            <p class="text-gray-500 text-sm">
                Daftar barang pada sistem.
            </p>

        </div>

        @if(Auth::user()->role == 'admin')

<a href="{{ route('barang.create') }}"
    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">

    + Tambah Barang

</a>

@endif

    </div>

    @if(session('success'))

        <div class="mx-6 mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">

            {{ session('success') }}

        </div>

    @endif

    
    <div class="px-6 py-4 border-b bg-gray-50">

    <form method="GET" action="{{ route('barang.index') }}">

        <div class="flex gap-3">

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari berdasarkan kode atau nama barang..."
                class="flex-1 border rounded-lg px-4 py-2">

            <button
                type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">

                Cari

            </button>

            <a
                href="{{ route('barang.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg">

                Reset

            </a>

        </div>

    </form>

</div>

    <div class="overflow-x-auto">

        <table class="min-w-full">

            <thead class="bg-gray-100">

                <tr>

                    <th class="px-5 py-3">No</th>
                    <th class="px-5 py-3">Kode</th>
                    <th class="px-5 py-3">Nama Barang</th>
                    <th class="px-5 py-3">Kategori</th>
                    <th class="px-5 py-3">Supplier</th>
                    <th class="px-5 py-3">Gudang</th>
                    <th class="px-5 py-3">Stok</th>
                    <th class="px-5 py-3">Min. Stok</th>
                    <th class="px-5 py-3">Satuan</th>
                    <th class="px-5 py-3">Harga</th>
                    <th class="px-5 py-3">Status</th>
                    <th class="px-5 py-3 text-center">Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse($barang as $item)

                <tr class="border-t hover:bg-gray-50">

                    <td class="px-5 py-3">

                        {{ $loop->iteration }}

                    </td>

                    <td class="px-5 py-3">

                        {{ $item->kode_barang }}

                    </td>

                    <td class="px-5 py-3">

                        {{ $item->nama_barang }}

                    </td>

                    <td class="px-5 py-3">

                        {{ $item->kategori->nama_kategori }}

                    </td>

                    <td class="px-5 py-3">

                        {{ $item->supplier->nama_supplier }}

                    </td>

                    <td class="px-5 py-3">

                        {{ $item->gudang->nama_gudang }}

                    </td>

                    <td class="px-5 py-3 text-center">

                        {{ $item->stok }}

                    </td>

                    <td class="px-5 py-3 text-center">

                        {{ $item->stok_minimum }}

                    </td>

                    <td class="px-5 py-3">

                        {{ $item->satuan }}

                    </td>

                    <td class="px-5 py-3">

                        Rp {{ number_format($item->harga, 0, ',', '.') }}

                    </td>

                    <td class="px-5 py-3">

                        @if($item->status == 'Aktif')

                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">

                                Aktif

                            </span>

                        @else

                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">

                                Nonaktif

                            </span>

                        @endif

                    </td>

                    <td class="px-5 py-3">
                        @if(Auth::user()->role == 'admin')

                        <div class="flex justify-center gap-2">

                            <a href="{{ route('barang.edit', $item->id) }}"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">

                                Edit

                            </a>

                            <form
                                id="delete-form-{{ $item->id }}"
                                action="{{ route('barang.destroy', $item->id) }}"
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
                        @endif

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="12"
                        class="text-center py-8 text-gray-500">

                        Belum ada data barang.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection