<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>SIM Gudang</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- Sidebar -->
<aside class="w-64 bg-slate-800 text-white">

    <div class="p-6 border-b border-slate-700">

        <h1 class="text-2xl font-bold">
            SIM GUDANG
        </h1>

        <p class="text-sm text-slate-300 mt-1">
            Sistem Informasi Manajemen Gudang
        </p>

    </div>

    <nav class="mt-4">

        {{-- ===================== ADMIN ===================== --}}
        @if(Auth::user()->role == 'admin')

            <a href="{{ route('dashboard') }}"
                class="block px-6 py-3 hover:bg-slate-700 {{ request()->routeIs('dashboard') ? 'bg-slate-700' : '' }}">
                Dashboard
            </a>

            <a href="{{ route('kategori.index') }}"
                class="block px-6 py-3 hover:bg-slate-700 {{ request()->routeIs('kategori.*') ? 'bg-slate-700' : '' }}">
                Kategori
            </a>

            <a href="{{ route('supplier.index') }}"
                class="block px-6 py-3 hover:bg-slate-700 {{ request()->routeIs('supplier.*') ? 'bg-slate-700' : '' }}">
                Supplier
            </a>

            <a href="{{ route('gudang.index') }}"
                class="block px-6 py-3 hover:bg-slate-700 {{ request()->routeIs('gudang.*') ? 'bg-slate-700' : '' }}">
                Gudang
            </a>

            <a href="{{ route('barang.index') }}"
                class="block px-6 py-3 hover:bg-slate-700 {{ request()->routeIs('barang.*') ? 'bg-slate-700' : '' }}">
                Barang
            </a>

            <a href="{{ route('barang-masuk.index') }}"
                class="block px-6 py-3 hover:bg-slate-700 {{ request()->routeIs('barang-masuk.*') ? 'bg-slate-700' : '' }}">
                Barang Masuk
            </a>

            <a href="{{ route('barang-keluar.index') }}"
                class="block px-6 py-3 hover:bg-slate-700 {{ request()->routeIs('barang-keluar.*') ? 'bg-slate-700' : '' }}">
                Barang Keluar
            </a>

            <a href="{{ route('laporan.barang') }}"
                class="block px-6 py-3 hover:bg-slate-700">
                Laporan Barang
            </a>

            <a href="{{ route('laporan.barang-masuk') }}"
                class="block px-6 py-3 hover:bg-slate-700">
                Laporan Barang Masuk
            </a>

            <a href="{{ route('laporan.barang-keluar') }}"
                class="block px-6 py-3 hover:bg-slate-700">
                Laporan Barang Keluar
            </a>

        @endif

        {{-- ===================== MANAJER ===================== --}}
        @if(Auth::user()->role == 'manajer')

            <a href="{{ route('manajer.dashboard') }}"
                class="block px-6 py-3 hover:bg-slate-700">
                Dashboard
            </a>

            <a href="{{ route('manajer.barang') }}"
                class="block px-6 py-3 hover:bg-slate-700">
                Data Barang
            </a>

            <a href="{{ route('manajer.laporan.barang') }}"
                class="block px-6 py-3 hover:bg-slate-700">
                Laporan Barang
            </a>

            <a href="{{ route('manajer.laporan.barangMasuk') }}"
                class="block px-6 py-3 hover:bg-slate-700">
                Laporan Barang Masuk
            </a>

            <a href="{{ route('manajer.laporan.barangKeluar') }}"
                class="block px-6 py-3 hover:bg-slate-700">
                Laporan Barang Keluar
            </a>

        @endif

    </nav>

</aside>


    <!-- Main -->
    <main class="flex-1">

        <!-- Navbar -->
        <header class="bg-white shadow">

            <div class="flex justify-between items-center px-8 py-4">

                <div>

                    <h2 class="text-2xl font-bold">
                        @yield('title')
                    </h2>

                </div>

                <div class="flex items-center gap-4">

                    <div class="text-right">

                        <div class="font-semibold">
                            {{ Auth::user()->name }}
                        </div>

                        <div class="text-sm text-gray-500">
                            {{ ucfirst(Auth::user()->role) }}
                        </div>

                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button
                            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">

                            Logout

                        </button>

                    </form>

                </div>

            </div>

        </header>

        <!-- Content -->
        <section class="p-8">

            @yield('content')

        </section>

    </main>

</div>

{{-- SweetAlert Success --}}
@if(session('success'))

<script>
Swal.fire({
    icon: 'success',
    title: 'Berhasil',
    text: "{{ session('success') }}",
    confirmButtonColor: '#2563eb',
    confirmButtonText: 'OK'
});
</script>

@endif

{{-- SweetAlert Error --}}
@if(session('error'))

<script>
Swal.fire({
    icon: 'error',
    title: 'Oops...',
    text: "{{ session('error') }}",
    confirmButtonColor: '#dc2626'
});
</script>

@endif

{{-- SweetAlert Delete --}}
<script>

function confirmDelete(formId){

    console.log('Fungsi dari layouts.admin dijalankan');

    Swal.fire({
        title: 'Hapus Data?',
        text: 'Data yang sudah dihapus tidak dapat dikembalikan!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus'
    }).then((result)=>{
        if(result.isConfirmed){
            document.getElementById(formId).submit();
        }
    });

}

</script>

</body>
</html>

