@extends('layouts.admin')

@section('title', 'Tambah Kategori')

@section('content')

<div class="bg-white rounded-xl shadow p-6">

    <div class="mb-6">
        <h2 class="text-2xl font-bold">Tambah Kategori</h2>
        <p class="text-gray-500">Masukkan data kategori barang.</p>
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

    <form action="{{ route('kategori.store') }}" method="POST">

        @csrf

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Kode Kategori
            </label>

            <input
                type="text"
                name="kode_kategori"
                value="{{ old('kode_kategori') }}"
                class="w-full border rounded-lg px-4 py-2"
                placeholder="Contoh : KTG001">

        </div>

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Nama Kategori
            </label>

            <input
                type="text"
                name="nama_kategori"
                value="{{ old('nama_kategori') }}"
                class="w-full border rounded-lg px-4 py-2"
                placeholder="Contoh : Elektronik">

        </div>

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Deskripsi
            </label>

            <textarea
                name="deskripsi"
                rows="4"
                class="w-full border rounded-lg px-4 py-2"
                placeholder="Masukkan deskripsi kategori">{{ old('deskripsi') }}</textarea>

        </div>

        <div class="flex gap-3">

            <button
                type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">

                Simpan

            </button>

            <a
                href="{{ route('kategori.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg">

                Kembali

            </a>

        </div>

    </form>

</div>

@endsection