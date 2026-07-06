@extends('layouts.admin')

@section('title', 'Data Supplier')

@section('content')

<div class="bg-white rounded-lg shadow">

    {{-- Header --}}
    <div class="flex justify-between items-center p-6 border-b">

        <div>

            <h3 class="text-xl font-semibold">
                Data Supplier
            </h3>

            <p class="text-gray-500 text-sm">
                Daftar supplier pada sistem.
            </p>

        </div>

        <a href="{{ route('supplier.create') }}"
            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">

            + Tambah Supplier

        </a>

    </div>

    {{-- Search --}}
    <div class="px-6 py-4 border-b bg-gray-50">

        <form method="GET" action="{{ route('supplier.index') }}">

            <div class="flex gap-3">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari kode atau nama supplier..."
                    class="flex-1 border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">

                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">

                    Cari

                </button>

                <a
                    href="{{ route('supplier.index') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg">

                    Reset

                </a>

            </div>

        </form>

    </div>

    {{-- Tabel --}}
    <div class="overflow-x-auto">

        <table class="min-w-full">

            <thead class="bg-gray-100">

                <tr>

                    <th class="px-5 py-3">No</th>
                    <th class="px-5 py-3">Kode</th>
                    <th class="px-5 py-3">Nama Supplier</th>
                    <th class="px-5 py-3">Alamat</th>
                    <th class="px-5 py-3">Telepon</th>
                    <th class="px-5 py-3">Email</th>
                    <th class="px-5 py-3 text-center">Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse($supplier as $item)

                <tr class="border-t hover:bg-gray-50">

                    <td class="px-5 py-3">
                        {{ $loop->iteration }}
                    </td>

                    <td class="px-5 py-3">
                        {{ $item->kode_supplier }}
                    </td>

                    <td class="px-5 py-3">
                        {{ $item->nama_supplier }}
                    </td>

                    <td class="px-5 py-3">
                        {{ $item->alamat }}
                    </td>

                    <td class="px-5 py-3">
                        {{ $item->telepon }}
                    </td>

                    <td class="px-5 py-3">
                        {{ $item->email }}
                    </td>

                    <td class="px-5 py-3">

                        <div class="flex justify-center gap-2">

                            <a href="{{ route('supplier.edit',$item->id) }}"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">

                                Edit

                            </a>

                            <form
                                id="delete-form-{{ $item->id }}"
                                action="{{ route('supplier.destroy',$item->id) }}"
                                method="POST">

                                @csrf
                                @method('DELETE')

                                <button
                                    type="button"
                                    onclick="confirmDelete('delete-form-{{ $item->id }}')"
                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">

                                    Hapus

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="7"
                        class="text-center py-8 text-gray-500">

                        Tidak ada data supplier.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection