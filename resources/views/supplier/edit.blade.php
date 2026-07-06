@extends('layouts.admin')

@section('title', 'Edit Supplier')

@section('content')

<div class="bg-white rounded-xl shadow p-6">

    <div class="mb-6">

        <h2 class="text-2xl font-bold">
            Edit Supplier
        </h2>

        <p class="text-gray-500">
            Ubah data supplier.
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

    <form action="{{ route('supplier.update', $supplier->id) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Kode Supplier
            </label>

            <input
                type="text"
                name="kode_supplier"
                value="{{ old('kode_supplier', $supplier->kode_supplier) }}"
                class="w-full border rounded-lg px-4 py-2">

        </div>

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Nama Supplier
            </label>

            <input
                type="text"
                name="nama_supplier"
                value="{{ old('nama_supplier', $supplier->nama_supplier) }}"
                class="w-full border rounded-lg px-4 py-2">

        </div>

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Alamat
            </label>

            <textarea
                name="alamat"
                rows="3"
                class="w-full border rounded-lg px-4 py-2">{{ old('alamat', $supplier->alamat) }}</textarea>

        </div>

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Telepon
            </label>

            <input
                type="text"
                name="telepon"
                value="{{ old('telepon', $supplier->telepon) }}"
                class="w-full border rounded-lg px-4 py-2">

        </div>

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Email
            </label>

            <input
                type="email"
                name="email"
                value="{{ old('email', $supplier->email) }}"
                class="w-full border rounded-lg px-4 py-2">

        </div>

        <div class="flex gap-3">

            <button
                type="submit"
                class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded-lg">

                Update

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