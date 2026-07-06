@extends('layouts.admin')

@section('title', 'Tambah Gudang')

@section('content')

<div class="bg-white rounded-xl shadow p-6">

    <div class="mb-6">

        <h2 class="text-2xl font-bold">
            Tambah Gudang
        </h2>

        <p class="text-gray-500">
            Masukkan data gudang.
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

    <form action="{{ route('gudang.store') }}" method="POST">

        @csrf

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Kode Gudang
            </label>

            <input
                type="text"
                name="kode_gudang"
                value="{{ old('kode_gudang') }}"
                class="w-full border rounded-lg px-4 py-2"
                placeholder="Contoh : GDG001">

        </div>

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Nama Gudang
            </label>

            <input
                type="text"
                name="nama_gudang"
                value="{{ old('nama_gudang') }}"
                class="w-full border rounded-lg px-4 py-2"
                placeholder="Contoh : Gudang Utama">

        </div>

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Lokasi
            </label>

            <textarea
                name="lokasi"
                rows="3"
                class="w-full border rounded-lg px-4 py-2"
                placeholder="Masukkan lokasi gudang">{{ old('lokasi') }}</textarea>

        </div>

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Kapasitas
            </label>

            <input
                type="number"
                name="kapasitas"
                value="{{ old('kapasitas') }}"
                class="w-full border rounded-lg px-4 py-2"
                placeholder="Contoh : 1000">

        </div>

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Keterangan
            </label>

            <textarea
                name="keterangan"
                rows="3"
                class="w-full border rounded-lg px-4 py-2"
                placeholder="Masukkan keterangan gudang">{{ old('keterangan') }}</textarea>

        </div>

        <div class="flex gap-3">

            <button
                type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">

                Simpan

            </button>

            <a
                href="{{ route('gudang.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg">

                Kembali

            </a>

        </div>

    </form>

</div>

@endsection