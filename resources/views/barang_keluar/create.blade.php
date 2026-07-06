@extends('layouts.admin')

@section('title', 'Tambah Barang Keluar')

@section('content')

<div class="bg-white rounded-xl shadow p-6">

    <div class="mb-6">

        <h2 class="text-2xl font-bold">
            Tambah Barang Keluar
        </h2>

        <p class="text-gray-500">
            Masukkan data transaksi barang keluar.
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

    <form action="{{ route('barang-keluar.store') }}" method="POST">

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
                placeholder="Contoh : BK001">

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
                Tujuan
            </label>

            <input
                type="text"
                name="tujuan"
                value="{{ old('tujuan') }}"
                class="w-full border rounded-lg px-4 py-2"
                placeholder="Contoh : PT ABC">

        </div>

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Barang
            </label>

            <select
                name="barang_id"
                class="w-full border rounded-lg px-4 py-2">

                <option value="">
                    -- Pilih Barang --
                </option>

                @foreach($barang as $item)

                    <option
                        value="{{ $item->id }}"
                        {{ old('barang_id') == $item->id ? 'selected' : '' }}>

                        {{ $item->kode_barang }} - {{ $item->nama_barang }}
                        (Stok : {{ $item->stok }})

                    </option>

                @endforeach

            </select>

        </div>

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Jumlah Keluar
            </label>

            <input
                type="number"
                name="jumlah"
                min="1"
                value="{{ old('jumlah') }}"
                class="w-full border rounded-lg px-4 py-2">

        </div>

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Harga Jual
            </label>

            <input
                type="number"
                name="harga_jual"
                min="0"
                value="{{ old('harga_jual') }}"
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
                href="{{ route('barang-keluar.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg">

                Kembali

            </a>

        </div>

    </form>

</div>

@endsection