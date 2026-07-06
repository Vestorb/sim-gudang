@extends('layouts.admin')

@section('title', 'Edit Barang Masuk')

@section('content')

<div class="bg-white rounded-xl shadow p-6">

    <div class="mb-6">

        <h2 class="text-2xl font-bold">
            Edit Barang Masuk
        </h2>

        <p class="text-gray-500">
            Ubah data transaksi barang masuk.
        </p>

    </div>

    @if ($errors->any())

        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-5">

            <ul class="list-disc ml-5">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <form action="{{ route('barang-masuk.update', $barangMasuk->id) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Nomor Transaksi
            </label>

            <input
                type="text"
                name="nomor_transaksi"
                value="{{ old('nomor_transaksi', $barangMasuk->nomor_transaksi) }}"
                class="w-full border rounded-lg px-4 py-2">

        </div>

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Tanggal
            </label>

            <input
                type="date"
                name="tanggal"
                value="{{ old('tanggal', $barangMasuk->tanggal) }}"
                class="w-full border rounded-lg px-4 py-2">

        </div>

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Supplier
            </label>

            <select
                name="supplier_id"
                class="w-full border rounded-lg px-4 py-2">

                @foreach($supplier as $item)

                    <option
                        value="{{ $item->id }}"
                        {{ old('supplier_id', $barangMasuk->supplier_id) == $item->id ? 'selected' : '' }}>

                        {{ $item->nama_supplier }}

                    </option>

                @endforeach

            </select>

        </div>

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Barang
            </label>

            <select
                name="barang_id"
                class="w-full border rounded-lg px-4 py-2">

                @foreach($barang as $item)

                    <option
                        value="{{ $item->id }}"
                        {{ old('barang_id', $detail->barang_id) == $item->id ? 'selected' : '' }}>

                        {{ $item->kode_barang }} - {{ $item->nama_barang }}

                    </option>

                @endforeach

            </select>

        </div>

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Jumlah Masuk
            </label>

            <input
                type="number"
                min="1"
                name="jumlah"
                value="{{ old('jumlah', $detail->jumlah) }}"
                class="w-full border rounded-lg px-4 py-2">

        </div>

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Harga Beli
            </label>

            <input
                type="number"
                min="0"
                name="harga_beli"
                value="{{ old('harga_beli', $detail->harga_beli) }}"
                class="w-full border rounded-lg px-4 py-2">

        </div>

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Status
            </label>

            <select
                name="status"
                class="w-full border rounded-lg px-4 py-2">

                <option value="Draft"
                    {{ old('status', $barangMasuk->status) == 'Draft' ? 'selected' : '' }}>
                    Draft
                </option>

                <option value="Selesai"
                    {{ old('status', $barangMasuk->status) == 'Selesai' ? 'selected' : '' }}>
                    Selesai
                </option>

                <option value="Dibatalkan"
                    {{ old('status', $barangMasuk->status) == 'Dibatalkan' ? 'selected' : '' }}>
                    Dibatalkan
                </option>

            </select>

        </div>

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Keterangan
            </label>

            <textarea
                name="keterangan"
                rows="4"
                class="w-full border rounded-lg px-4 py-2">{{ old('keterangan', $barangMasuk->keterangan) }}</textarea>

        </div>

        <div class="flex gap-3">

            <button
                type="submit"
                class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded-lg">

                Update

            </button>

            <a
                href="{{ route('barang-masuk.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg">

                Kembali

            </a>

        </div>

    </form>

</div>

@endsection