<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <title>Laporan Barang</title>

    <style>

        body{
            font-family: DejaVu Sans, sans-serif;
            font-size:12px;
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
            border:1px solid #000;
            background:#dddddd;
            padding:8px;
            text-align:center;
        }

        table td{
            border:1px solid #000;
            padding:6px;
        }

        .text-center{
            text-align:center;
        }

        .text-right{
            text-align:right;
        }

        .footer{
            margin-top:30px;
            text-align:right;
            font-size:11px;
        }

    </style>

</head>

<body>

<h2>
    LAPORAN DATA BARANG
</h2>

<p>
    Sistem Informasi Manajemen Gudang
</p>

<table>

    <thead>

    <tr>

        <th>No</th>
        <th>Kode</th>
        <th>Nama Barang</th>
        <th>Kategori</th>
        <th>Supplier</th>
        <th>Gudang</th>
        <th>Stok</th>
        <th>Satuan</th>
        <th>Harga</th>

    </tr>

    </thead>

    <tbody>

    @foreach($barang as $item)

    <tr>

        <td class="text-center">
            {{ $loop->iteration }}
        </td>

        <td>
            {{ $item->kode_barang }}
        </td>

        <td>
            {{ $item->nama_barang }}
        </td>

        <td>
            {{ $item->kategori->nama_kategori }}
        </td>

        <td>
            {{ $item->supplier->nama_supplier }}
        </td>

        <td>
            {{ $item->gudang->nama_gudang }}
        </td>

        <td class="text-center">
            {{ $item->stok }}
        </td>

        <td class="text-center">
            {{ $item->satuan }}
        </td>

        <td class="text-right">
            Rp {{ number_format($item->harga,0,',','.') }}
        </td>

    </tr>

    @endforeach

    </tbody>

</table>

<div class="footer">

    Dicetak pada :
    {{ now()->format('d-m-Y H:i:s') }}

</div>

</body>
</html>