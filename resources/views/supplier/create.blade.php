@extends('layouts.admin')

@section('title', 'Tambah Supplier')

@section('content')

<div class="bg-white rounded-xl shadow p-6">

    <div class="mb-6">

        <h2 class="text-2xl font-bold">
            Tambah Supplier
        </h2>

        <p class="text-gray-500">
            Masukkan data supplier.
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

    <form action="{{ route('supplier.store') }}" method="POST">

        @csrf

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Kode Supplier
            </label>

            <input
                type="text"
                name="kode_supplier"
                value="{{ old('kode_supplier') }}"
                class="w-full border rounded-lg px-4 py-2"
                placeholder="Contoh : SUP001">

        </div>

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Nama Supplier
            </label>

            <input
                type="text"
                name="nama_supplier"
                value="{{ old('nama_supplier') }}"
                class="w-full border rounded-lg px-4 py-2"
                placeholder="Contoh : PT Sumber Makmur">

        </div>

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Alamat
            </label>

            <textarea
                name="alamat"
                rows="3"
                class="w-full border rounded-lg px-4 py-2"
                placeholder="Masukkan alamat supplier">{{ old('alamat') }}</textarea>

        </div>

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Telepon
            </label>

            <input
                type="text"
                name="telepon"
                value="{{ old('telepon') }}"
                class="w-full border rounded-lg px-4 py-2"
                placeholder="08xxxxxxxxxx">

        </div>

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Email
            </label>

            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                class="w-full border rounded-lg px-4 py-2"
                placeholder="supplier@email.com">

        </div>

        <div class="flex gap-3">

            <button
                type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">

                Simpan

            </button>

            <a
                href="{{ route('supplier.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg">

                Kembali

            </a>

        </div>

    </form>

</div>

@endsection