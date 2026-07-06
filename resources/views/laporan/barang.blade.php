@extends('layouts.admin')

@section('title', 'Laporan Barang')

@section('content')

<div class="space-y-6">

    <!-- Header -->
    <div class="flex items-center justify-between">

        <div>
            <h2 class="text-2xl font-bold text-gray-800">
                Laporan Data Barang
            </h2>

            <p class="text-gray-500 mt-1">
                Menampilkan seluruh data barang yang tersedia di gudang.
            </p>
        </div>

        <a href="{{ route('laporan.barang.pdf') }}"
            class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg shadow">

            📄 Export PDF

        </a>

    </div>

    <!-- Ringkasan -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

        <div class="bg-white rounded-xl shadow p-6">

            <div class="text-gray-500">
                Total Barang
            </div>

            <div class="text-3xl font-bold text-blue-600 mt-2">

                {{ $barang->count() }}

            </div>

        </div>

        <div class="bg-white rounded-xl shadow p-6">

            <div class="text-gray-500">
                Total Stok
            </div>

            <div class="text-3xl font-bold text-green-600 mt-2">

                {{ $barang->sum('stok') }}

            </div>

        </div>

        <div class="bg-white rounded-xl shadow p-6">

            <div class="text-gray-500">
                Nilai Persediaan
            </div>

            <div class="text-2xl font-bold text-red-600 mt-2">

                Rp {{ number_format($barang->sum(fn($b) => $b->stok * $b->harga),0,',','.') }}

            </div>

        </div>

    </div>

    <!-- Tabel -->
    <div class="bg-white rounded-xl shadow">

        <div class="overflow-x-auto">

            <table class="min-w-full border-collapse">

                <thead>

                <tr class="bg-slate-800 text-white">

                    <th class="px-4 py-3 border">No</th>
                    <th class="px-4 py-3 border">Kode</th>
                    <th class="px-4 py-3 border text-left">Nama Barang</th>
                    <th class="px-4 py-3 border">Kategori</th>
                    <th class="px-4 py-3 border">Supplier</th>
                    <th class="px-4 py-3 border">Gudang</th>
                    <th class="px-4 py-3 border">Stok</th>
                    <th class="px-4 py-3 border">Satuan</th>
                    <th class="px-4 py-3 border text-right">Harga</th>

                </tr>

                </thead>

                <tbody>

                @forelse($barang as $item)

                <tr class="hover:bg-gray-50">

                    <td class="border px-4 py-3 text-center">
                        {{ $loop->iteration }}
                    </td>

                    <td class="border px-4 py-3">
                        {{ $item->kode_barang }}
                    </td>

                    <td class="border px-4 py-3 font-medium">
                        {{ $item->nama_barang }}
                    </td>

                    <td class="border px-4 py-3">
                        {{ $item->kategori->nama_kategori }}
                    </td>

                    <td class="border px-4 py-3">
                        {{ $item->supplier->nama_supplier }}
                    </td>

                    <td class="border px-4 py-3">
                        {{ $item->gudang->nama_gudang }}
                    </td>

                    <td class="border px-4 py-3 text-center">
                        {{ $item->stok }}
                    </td>

                    <td class="border px-4 py-3 text-center">
                        {{ $item->satuan }}
                    </td>

                    <td class="border px-4 py-3 text-right">
                        Rp {{ number_format($item->harga,0,',','.') }}
                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="9"
                        class="text-center py-8 text-gray-500">

                        Belum ada data barang.

                    </td>

                </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection