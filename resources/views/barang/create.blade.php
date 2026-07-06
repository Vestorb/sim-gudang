@extends('layouts.admin')

@section('title', 'Tambah Barang')

@section('content')

<div class="bg-white rounded-xl shadow p-6">

    <div class="mb-6">

        <h2 class="text-2xl font-bold">
            Tambah Barang
        </h2>

        <p class="text-gray-500">
            Masukkan data barang.
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

    <form action="{{ route('barang.store') }}" method="POST">

        @csrf

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Kode Barang
            </label>

            <input
                type="text"
                name="kode_barang"
                value="{{ old('kode_barang') }}"
                class="w-full border rounded-lg px-4 py-2"
                placeholder="Contoh : BRG001">

        </div>

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Nama Barang
            </label>

            <input
                type="text"
                name="nama_barang"
                value="{{ old('nama_barang') }}"
                class="w-full border rounded-lg px-4 py-2"
                placeholder="Masukkan nama barang">

        </div>

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Kategori
            </label>

            <select
                name="kategori_id"
                class="w-full border rounded-lg px-4 py-2">

                <option value="">-- Pilih Kategori --</option>

                @foreach($kategori as $item)

                    <option
                        value="{{ $item->id }}"
                        {{ old('kategori_id') == $item->id ? 'selected' : '' }}>

                        {{ $item->nama_kategori }}

                    </option>

                @endforeach

            </select>

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
                Gudang
            </label>

            <select
                name="gudang_id"
                class="w-full border rounded-lg px-4 py-2">

                <option value="">-- Pilih Gudang --</option>

                @foreach($gudang as $item)

                    <option
                        value="{{ $item->id }}"
                        {{ old('gudang_id') == $item->id ? 'selected' : '' }}>

                        {{ $item->nama_gudang }}

                    </option>

                @endforeach

            </select>

        </div>

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Satuan
            </label>

            <input
                type="text"
                name="satuan"
                value="{{ old('satuan') }}"
                class="w-full border rounded-lg px-4 py-2"
                placeholder="Contoh : Pcs">

        </div>

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Harga
            </label>

            <input
                type="number"
                name="harga"
                value="{{ old('harga') }}"
                class="w-full border rounded-lg px-4 py-2"
                placeholder="0">

        </div>

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Stok Minimum
            </label>

            <input
                type="number"
                name="stok_minimum"
                value="{{ old('stok_minimum') }}"
                class="w-full border rounded-lg px-4 py-2"
                placeholder="5">

        </div>

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Status
            </label>

            <select
                name="status"
                class="w-full border rounded-lg px-4 py-2">

                <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>
                    Aktif
                </option>

                <option value="Nonaktif" {{ old('status') == 'Nonaktif' ? 'selected' : '' }}>
                    Nonaktif
                </option>

            </select>

        </div>

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Deskripsi
            </label>

            <textarea
                name="deskripsi"
                rows="4"
                class="w-full border rounded-lg px-4 py-2"
                placeholder="Masukkan deskripsi barang">{{ old('deskripsi') }}</textarea>

        </div>

        <div class="flex gap-3">

            <button
                type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">

                Simpan

            </button>

            <a
                href="{{ route('barang.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg">

                Kembali

            </a>

        </div>

    </form>

</div>

@endsection