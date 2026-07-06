@extends('layouts.admin')

@section('title', 'Tambah Barang Masuk')

@section('content')

<div class="bg-white rounded-xl shadow p-6">

    <div class="mb-6">

        <h2 class="text-2xl font-bold">
            Tambah Barang Masuk
        </h2>

        <p class="text-gray-500">
            Masukkan data transaksi barang masuk.
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

    <form action="{{ route('barang-masuk.store') }}" method="POST">

        @csrf

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Nomor Transaksi
            </label>

            <input
                type="text"
                name="nomor_transaksi"
                value="{{ old('nomor_transaksi') }}"
                class="w-full border rounded-lg px-4 py-2"
                placeholder="Contoh : BM001">

        </div>

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Tanggal
            </label>

            <input
                type="date"
                name="tanggal"
                value="{{ old('tanggal', date('Y-m-d')) }}"
                class="w-full border rounded-lg px-4 py-2">

        </div>

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Supplier
            </label>

            <select
                name="supplier_id"
                class="w-full border rounded-lg px-4 py-2">

                <option value="">-- Pilih Supplier --</option>

                @foreach($supplier as $item)

                    <option
                        value="{{ $item->id }}"
                        {{ old('supplier_id') == $item->id ? 'selected' : '' }}>

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

                <option value="">-- Pilih Barang --</option>

                @foreach($barang as $item)

                    <option
                        value="{{ $item->id }}"
                        {{ old('barang_id') == $item->id ? 'selected' : '' }}>

                        {{ $item->kode_barang }}
                        -
                        {{ $item->nama_barang }}

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
                value="{{ old('jumlah') }}"
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
                value="{{ old('harga_beli') }}"
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
                    {{ old('status') == 'Draft' ? 'selected' : '' }}>

                    Draft

                </option>

                <option value="Selesai"
                    {{ old('status') == 'Selesai' ? 'selected' : '' }}>

                    Selesai

                </option>

                <option value="Dibatalkan"
                    {{ old('status') == 'Dibatalkan' ? 'selected' : '' }}>

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
                class="w-full border rounded-lg px-4 py-2"
                placeholder="Masukkan keterangan">{{ old('keterangan') }}</textarea>

        </div>

        <div class="flex gap-3">

            <button
                type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">

                Simpan

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