<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailBarangMasuk extends Model
{
    protected $table = 'detail_barang_masuk';

    protected $fillable = [
        'barang_masuk_id',
        'barang_id',
        'jumlah',
        'harga_beli',
        'subtotal'
    ];

    public function barangMasuk(): BelongsTo
    {
    return $this->belongsTo(BarangMasuk::class);
    }

    public function barang(): BelongsTo
    {
    return $this->belongsTo(Barang::class);
    }
}