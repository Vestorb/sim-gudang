@extends('layouts.admin')

@section('title', 'Edit Gudang')

@section('content')

<div class="bg-white rounded-xl shadow p-6">

    <div class="mb-6">

        <h2 class="text-2xl font-bold">
            Edit Gudang
        </h2>

        <p class="text-gray-500">
            Ubah data gudang.
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

    <form action="{{ route('gudang.update', $gudang->id) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Kode Gudang
            </label>

            <input
                type="text"
                name="kode_gudang"
                value="{{ old('kode_gudang', $gudang->kode_gudang) }}"
                class="w-full border rounded-lg px-4 py-2">

        </div>

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Nama Gudang
            </label>

            <input
                type="text"
                name="nama_gudang"
                value="{{ old('nama_gudang', $gudang->nama_gudang) }}"
                class="w-full border rounded-lg px-4 py-2">

        </div>

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Lokasi
            </label>

            <textarea
                name="lokasi"
                rows="3"
                class="w-full border rounded-lg px-4 py-2">{{ old('lokasi', $gudang->lokasi) }}</textarea>

        </div>

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Kapasitas
            </label>

            <input
                type="number"
                name="kapasitas"
                value="{{ old('kapasitas', $gudang->kapasitas) }}"
                class="w-full border rounded-lg px-4 py-2">

        </div>

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Keterangan
            </label>

            <textarea
                name="keterangan"
                rows="3"
                class="w-full border rounded-lg px-4 py-2">{{ old('keterangan', $gudang->keterangan) }}</textarea>

        </div>

        <div class="flex gap-3">

            <button
                type="submit"
                class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded-lg">

                Update

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