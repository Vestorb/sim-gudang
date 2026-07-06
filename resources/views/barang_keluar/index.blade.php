@extends('layouts.admin')

@section('title', 'Data Barang Keluar')

@section('content')

<div class="bg-white rounded-lg shadow">

    {{-- Header --}}
    <div class="flex justify-between items-center p-6 border-b">

        <div>

            <h3 class="text-xl font-semibold">
                Data Barang Keluar
            </h3>

            <p class="text-gray-500 text-sm">
                Daftar transaksi barang keluar.
            </p>

        </div>

        <a href="{{ route('barang-keluar.create') }}"
            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">

            + Tambah Barang Keluar

        </a>

    </div>

    {{-- Search & Filter --}}
    <div class="px-6 py-4 border-b bg-gray-50">

        <form method="GET" action="{{ route('barang-keluar.index') }}">

            <div class="grid md:grid-cols-3 gap-3">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari Nomor Transaksi..."
                    class="border rounded-lg px-4 py-2">

                <input
                    type="date"
                    name="tanggal"
                    value="{{ request('tanggal') }}"
                    class="border rounded-lg px-4 py-2">

                <div class="flex gap-2">

                    <button
                        type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">

                        Cari

                    </button>

                    <a
                        href="{{ route('barang-keluar.index') }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg">

                        Reset

                    </a>

                </div>

            </div>

        </form>

    </div>

    @if(session('success'))

        <div class="mx-6 mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">

            {{ session('success') }}

        </div>

    @endif

    <div class="overflow-x-auto">

        <table class="min-w-full">

            <thead class="bg-gray-100">

                <tr>

                    <th class="px-5 py-3">No</th>

                    <th class="px-5 py-3">No Transaksi</th>

                    <th class="px-5 py-3">Tanggal</th>

                    <th class="px-5 py-3">Tujuan</th>

                    <th class="px-5 py-3">Barang</th>

                    <th class="px-5 py-3">Jumlah</th>

                    <th class="px-5 py-3">Harga Jual</th>

                    <th class="px-5 py-3">Subtotal</th>

                    <th class="px-5 py-3">Status</th>

                    <th class="px-5 py-3 text-center">
                        Aksi
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($barangKeluar as $item)

                    @php
                        $detail = $item->detailBarangKeluar->first();
                    @endphp

                    <tr class="border-t hover:bg-gray-50">

                        <td class="px-5 py-3">

                            {{ $loop->iteration }}

                        </td>

                        <td class="px-5 py-3">

                            {{ $item->nomor_transaksi }}

                        </td>

                        <td class="px-5 py-3">

                            {{ $item->tanggal }}

                        </td>

                        <td class="px-5 py-3">

                            {{ $item->tujuan }}

                        </td>

                        <td class="px-5 py-3">

                            {{ $detail->barang->nama_barang }}

                        </td>

                        <td class="px-5 py-3">

                            {{ $detail->jumlah }}

                        </td>

                        <td class="px-5 py-3">

                            Rp {{ number_format($detail->harga_jual,0,',','.') }}

                        </td>

                        <td class="px-5 py-3">

                            Rp {{ number_format($detail->subtotal,0,',','.') }}

                        </td>

                        <td class="px-5 py-3">

                            @if($item->status == 'Selesai')

                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded">

                                    Selesai

                                </span>

                            @elseif($item->status == 'Draft')

                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded">

                                    Draft

                                </span>

                            @else

                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded">

                                    Dibatalkan

                                </span>

                            @endif

                        </td>

                        <td class="px-5 py-3">

                            <div class="flex justify-center gap-2">

                                <a
                                    href="{{ route('barang-keluar.edit', $item->id) }}"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">

                                    Edit

                                </a>

                                <form
                                    id="delete-form-{{ $item->id }}"
                                    action="{{ route('barang-keluar.destroy', $item->id) }}"
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

                        <td colspan="10"
                            class="text-center py-8 text-gray-500">

                            Belum ada transaksi barang keluar.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection