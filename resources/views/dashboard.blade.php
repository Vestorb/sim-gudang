@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<h2 class="text-3xl font-bold mb-6">
    Selamat Datang, {{ Auth::user()->name }}
</h2>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

    <div class="bg-blue-600 text-white rounded-xl p-6 shadow">
        <h3 class="text-lg">Total Barang</h3>
        <p class="text-4xl font-bold mt-3">
            {{ $totalBarang }}
        </p>
    </div>

    <div class="bg-green-600 text-white rounded-xl p-6 shadow">
        <h3 class="text-lg">Total Supplier</h3>
        <p class="text-4xl font-bold mt-3">
            {{ $totalSupplier }}
        </p>
    </div>

    <div class="bg-yellow-500 text-white rounded-xl p-6 shadow">
        <h3 class="text-lg">Total Gudang</h3>
        <p class="text-4xl font-bold mt-3">
            {{ $totalGudang }}
        </p>
    </div>

    <div class="bg-indigo-600 text-white rounded-xl p-6 shadow">
        <h3 class="text-lg">Barang Masuk</h3>
        <p class="text-4xl font-bold mt-3">
            {{ $totalBarangMasuk }}
        </p>
    </div>

    <div class="bg-red-600 text-white rounded-xl p-6 shadow">
        <h3 class="text-lg">Barang Keluar</h3>
        <p class="text-4xl font-bold mt-3">
            {{ $totalBarangKeluar }}
        </p>
    </div>

    <div class="bg-orange-500 text-white rounded-xl p-6 shadow">
        <h3 class="text-lg">Stok Minimum</h3>
        <p class="text-4xl font-bold mt-3">
            {{ $stokMenipis }}
        </p>
    </div>

</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8">

    <div class="bg-white rounded-xl shadow p-6">

        <h3 class="text-xl font-bold mb-4">
            Grafik Barang Masuk
        </h3>

        <canvas id="barangMasukChart"></canvas>

    </div>

    <div class="bg-white rounded-xl shadow p-6">

        <h3 class="text-xl font-bold mb-4">
            Grafik Barang Keluar
        </h3>

        <canvas id="barangKeluarChart"></canvas>

    </div>

</div>

<div class="bg-white rounded-xl shadow p-6 mt-8">

    <h3 class="text-xl font-bold mb-3">
        Informasi Sistem
    </h3>

    <ul class="list-disc ml-6 space-y-2">

        <li>Total Barang tersedia: <b>{{ $totalBarang }}</b></li>

        <li>Total Supplier: <b>{{ $totalSupplier }}</b></li>

        <li>Total Gudang: <b>{{ $totalGudang }}</b></li>

        <li>Total Transaksi Barang Masuk: <b>{{ $totalBarangMasuk }}</b></li>

        <li>Total Transaksi Barang Keluar: <b>{{ $totalBarangKeluar }}</b></li>

        <li>Barang dengan stok minimum: <b>{{ $stokMenipis }}</b></li>

    </ul>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const bulan = [
    'Jan','Feb','Mar','Apr','Mei','Jun',
    'Jul','Agu','Sep','Okt','Nov','Des'
];

const masuk = Array(12).fill(0);

@foreach($barangMasukChart as $item)
masuk[{{ $item->bulan-1 }}] = {{ $item->total }};
@endforeach

new Chart(document.getElementById('barangMasukChart'),{

    type:'bar',

    data:{
        labels:bulan,
        datasets:[{
            label:'Barang Masuk',
            data:masuk
        }]
    }

});

const keluar = Array(12).fill(0);

@foreach($barangKeluarChart as $item)
keluar[{{ $item->bulan-1 }}] = {{ $item->total }};
@endforeach

new Chart(document.getElementById('barangKeluarChart'),{

    type:'line',

    data:{
        labels:bulan,
        datasets:[{
            label:'Barang Keluar',
            data:keluar
        }]
    }

});

</script>

@endsection