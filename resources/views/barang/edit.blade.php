@extends('layouts.admin')

@section('title', 'Edit Barang')

@section('content')

<div class="bg-white rounded-xl shadow p-6">

    <div class="mb-6">

        <h2 class="text-2xl font-bold">
            Edit Barang
        </h2>

        <p class="text-gray-500">
            Ubah data barang.
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

    <form action="{{ route('barang.update', $barang->id) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Kode Barang
            </label>

            <input
                type="text"
                name="kode_barang"
                value="{{ old('kode_barang', $barang->kode_barang) }}"
                class="w-full border rounded-lg px-4 py-2">

        </div>

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Nama Barang
            </label>

            <input
                type="text"
                name="nama_barang"
                value="{{ old('nama_barang', $barang->nama_barang) }}"
                class="w-full border rounded-lg px-4 py-2">

        </div>

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Kategori
            </label>

            <select
                name="kategori_id"
                class="w-full border rounded-lg px-4 py-2">

                @foreach($kategori as $item)

                    <option
                        value="{{ $item->id }}"
                        {{ old('kategori_id', $barang->kategori_id) == $item->id ? 'selected' : '' }}>

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

                @foreach($supplier as $item)

                    <option
                        value="{{ $item->id }}"
                        {{ old('supplier_id', $barang->supplier_id) == $item->id ? 'selected' : '' }}>

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

                @foreach($gudang as $item)

                    <option
                        value="{{ $item->id }}"
                        {{ old('gudang_id', $barang->gudang_id) == $item->id ? 'selected' : '' }}>

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
                value="{{ old('satuan', $barang->satuan) }}"
                class="w-full border rounded-lg px-4 py-2">

        </div>

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Harga
            </label>

            <input
                type="number"
                name="harga"
                value="{{ old('harga', $barang->harga) }}"
                class="w-full border rounded-lg px-4 py-2">

        </div>

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Stok Saat Ini
            </label>

            <input
                type="text"
                value="{{ $barang->stok }}"
                class="w-full border rounded-lg px-4 py-2 bg-gray-100"
                readonly>

        </div>

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Stok Minimum
            </label>

            <input
                type="number"
                name="stok_minimum"
                value="{{ old('stok_minimum', $barang->stok_minimum) }}"
                class="w-full border rounded-lg px-4 py-2">

        </div>

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Status
            </label>

            <select
                name="status"
                class="w-full border rounded-lg px-4 py-2">

                <option value="Aktif"
                    {{ old('status', $barang->status) == 'Aktif' ? 'selected' : '' }}>
                    Aktif
                </option>

                <option value="Nonaktif"
                    {{ old('status', $barang->status) == 'Nonaktif' ? 'selected' : '' }}>
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
                class="w-full border rounded-lg px-4 py-2">{{ old('deskripsi', $barang->deskripsi) }}</textarea>

        </div>

        <div class="flex gap-3">

            <button
                type="submit"
                class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded-lg">

                Update

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