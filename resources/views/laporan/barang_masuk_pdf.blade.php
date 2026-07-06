<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Barang Masuk</title>

    <style>

        body{
            font-family: DejaVu Sans, sans-serif;
            font-size:11px;
        }

        h2{
            text-align:center;
            margin-bottom:0;
        }

        p{
            text-align:center;
            margin-top:3px;
            margin-bottom:20px;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        table th{
            background:#d9d9d9;
            border:1px solid #000;
            padding:7px;
            text-align:center;
        }

        table td{
            border:1px solid #000;
            padding:6px;
        }

        .center{
            text-align:center;
        }

        .right{
            text-align:right;
        }

        .footer{
            margin-top:25px;
            text-align:right;
            font-size:10px;
        }

    </style>

</head>

<body>

<h2>
    LAPORAN BARANG MASUK
</h2>

<p>
    Sistem Informasi Manajemen Gudang
</p>

@if(request('tanggal_awal') && request('tanggal_akhir'))

<p>

Periode :
{{ \Carbon\Carbon::parse(request('tanggal_awal'))->format('d-m-Y') }}
s/d
{{ \Carbon\Carbon::parse(request('tanggal_akhir'))->format('d-m-Y') }}

</p>

@endif

<table>

<thead>

<tr>

    <th>No</th>
    <th>No Transaksi</th>
    <th>Tanggal</th>
    <th>Supplier</th>
    <th>Petugas</th>
    <th>Jumlah Item</th>
    <th>Status</th>

</tr>

</thead>

<tbody>

@foreach($barangMasuk as $item)

<tr>

    <td class="center">
        {{ $loop->iteration }}
    </td>

    <td>
        {{ $item->nomor_transaksi }}
    </td>

    <td class="center">
        {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}
    </td>

    <td>
        {{ $item->supplier->nama_supplier }}
    </td>

    <td>
        {{ $item->user->name }}
    </td>

    <td class="center">
        {{ $item->detailBarangMasuk->sum('jumlah') }}
    </td>

    <td class="center">
        {{ $item->status }}
    </td>

</tr>

@endforeach

</tbody>

</table>

<br>

<table width="40%" align="right">

<tr>

    <td>Total Transaksi</td>

    <td class="right">

        {{ $barangMasuk->count() }}

    </td>

</tr>

<tr>

    <td>Total Item</td>

    <td class="right">

        {{ $barangMasuk->sum(function($row){
            return $row->detailBarangMasuk->sum('jumlah');
        }) }}

    </td>

</tr>

</table>

<div class="footer">

Dicetak pada :

{{ now()->format('d-m-Y H:i:s') }}

</div>

</body>

</html><!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Barang Masuk</title>

    <style>

        body{
            font-family: DejaVu Sans, sans-serif;
            font-size:11px;
        }

        h2{
            text-align:center;
            margin-bottom:0;
        }

        p{
            text-align:center;
            margin-top:3px;
            margin-bottom:20px;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        table th{
            background:#d9d9d9;
            border:1px solid #000;
            padding:7px;
            text-align:center;
        }

        table td{
            border:1px solid #000;
            padding:6px;
        }

        .center{
            text-align:center;
        }

        .right{
            text-align:right;
        }

        .footer{
            margin-top:25px;
            text-align:right;
            font-size:10px;
        }

    </style>

</head>

<body>

<h2>
    LAPORAN BARANG MASUK
</h2>

<p>
    Sistem Informasi Manajemen Gudang
</p>

@if(request('tanggal_awal') && request('tanggal_akhir'))

<p>

Periode :
{{ \Carbon\Carbon::parse(request('tanggal_awal'))->format('d-m-Y') }}
s/d
{{ \Carbon\Carbon::parse(request('tanggal_akhir'))->format('d-m-Y') }}

</p>

@endif

<table>

<thead>

<tr>

    <th>No</th>
    <th>No Transaksi</th>
    <th>Tanggal</th>
    <th>Supplier</th>
    <th>Petugas</th>
    <th>Jumlah Item</th>
    <th>Status</th>

</tr>

</thead>

<tbody>

@foreach($barangMasuk as $item)

<tr>

    <td class="center">
        {{ $loop->iteration }}
    </td>

    <td>
        {{ $item->nomor_transaksi }}
    </td>

    <td class="center">
        {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}
    </td>

    <td>
        {{ $item->supplier->nama_supplier }}
    </td>

    <td>
        {{ $item->user->name }}
    </td>

    <td class="center">
        {{ $item->detailBarangMasuk->sum('jumlah') }}
    </td>

    <td class="center">
        {{ $item->status }}
    </td>

</tr>

@endforeach

</tbody>

</table>

<br>

<table width="40%" align="right">

<tr>

    <td>Total Transaksi</td>

    <td class="right">

        {{ $barangMasuk->count() }}

    </td>

</tr>

<tr>

    <td>Total Item</td>

    <td class="right">

        {{ $barangMasuk->sum(function($row){
            return $row->detailBarangMasuk->sum('jumlah');
        }) }}

    </td>

</tr>

</table>

<div class="footer">

Dicetak pada :

{{ now()->format('d-m-Y H:i:s') }}

</div>

</body>

</html>