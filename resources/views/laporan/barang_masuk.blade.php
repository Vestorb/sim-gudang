@extends('layouts.admin')

@section('title', 'Laporan Barang Masuk')

@section('content')

<div class="space-y-6">

    <!-- Header -->
    <div class="flex justify-between items-center">

        <div>

            <h2 class="text-2xl font-bold text-gray-800">
                Laporan Barang Masuk
            </h2>

            <p class="text-gray-500">
                Menampilkan seluruh transaksi barang masuk.
            </p>

        </div>

    </div>

    <!-- Filter -->
    <div class="bg-white rounded-xl shadow p-6">

        <form method="GET" action="{{ route('laporan.barang-masuk') }}">

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                <div>

                    <label class="block mb-2 font-semibold">
                        Tanggal Awal
                    </label>

                    <input
                        type="date"
                        name="tanggal_awal"
                        value="{{ request('tanggal_awal') }}"
                        class="w-full border rounded-lg px-3 py-2">

                </div>

                <div>

                    <label class="block mb-2 font-semibold">
                        Tanggal Akhir
                    </label>

                    <input
                        type="date"
                        name="tanggal_akhir"
                        value="{{ request('tanggal_akhir') }}"
                        class="w-full border rounded-lg px-3 py-2">

                </div>

                <div class="flex items-end">

                    <button
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">

                        Tampilkan

                    </button>

                </div>

                <div class="flex items-end">

                    <a
                        href="{{ route('laporan.barang-masuk.pdf', [
                            'tanggal_awal' => request('tanggal_awal'),
                            'tanggal_akhir' => request('tanggal_akhir')
                        ]) }}"
                        class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg">

                        Export PDF

                    </a>

                </div>

            </div>

        </form>

    </div>

    <!-- Ringkasan -->

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

        <div class="bg-white rounded-xl shadow p-6">

            <div class="text-gray-500">
                Total Transaksi
            </div>

            <div class="text-3xl font-bold text-blue-600 mt-2">

                {{ $barangMasuk->count() }}

            </div>

        </div>

        <div class="bg-white rounded-xl shadow p-6">

            <div class="text-gray-500">
                Total Item Masuk
            </div>

            <div class="text-3xl font-bold text-green-600 mt-2">

                {{ $barangMasuk->sum(function($row){
                    return $row->detailBarangMasuk->sum('jumlah');
                }) }}

            </div>

        </div>

    </div>

    <!-- Tabel -->

    <div class="bg-white rounded-xl shadow">

        <div class="overflow-x-auto">

            <table class="min-w-full">

                <thead>

                <tr class="bg-slate-800 text-white">

                    <th class="border px-4 py-3">No</th>
                    <th class="border px-4 py-3">No Transaksi</th>
                    <th class="border px-4 py-3">Tanggal</th>
                    <th class="border px-4 py-3">Supplier</th>
                    <th class="border px-4 py-3">Petugas</th>
                    <th class="border px-4 py-3">Jumlah Item</th>
                    <th class="border px-4 py-3">Status</th>

                </tr>

                </thead>

                <tbody>

                @forelse($barangMasuk as $item)

                    <tr class="hover:bg-gray-50">

                        <td class="border px-4 py-3 text-center">
                            {{ $loop->iteration }}
                        </td>

                        <td class="border px-4 py-3">
                            {{ $item->nomor_transaksi }}
                        </td>

                        <td class="border px-4 py-3">
                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}
                        </td>

                        <td class="border px-4 py-3">
                            {{ $item->supplier->nama_supplier }}
                        </td>

                        <td class="border px-4 py-3">
                            {{ $item->user->name }}
                        </td>

                        <td class="border px-4 py-3 text-center">
                            {{ $item->detailBarangMasuk->sum('jumlah') }}
                        </td>

                        <td class="border px-4 py-3 text-center">
                            {{ $item->status }}
                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7"
                            class="text-center py-8 text-gray-500">

                            Tidak ada data.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection