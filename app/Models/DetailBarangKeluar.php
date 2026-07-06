<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailBarangKeluar extends Model
{
    protected $table = 'detail_barang_keluar';

    protected $fillable = [
        'barang_keluar_id',
        'barang_id',
        'jumlah',
        'harga_jual',
        'subtotal'
    ];

    public function barangKeluar(): BelongsTo
    {
    return $this->belongsTo(BarangKeluar::class);
    }

    public function barang(): BelongsTo
    {
    return $this->belongsTo(Barang::class);
    }
}