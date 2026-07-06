<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BarangMasuk extends Model
{
    protected $table = 'barang_masuk';

    protected $fillable = [
        'nomor_transaksi',
        'tanggal',
        'supplier_id',
        'user_id',
        'status',
        'keterangan'
    ];

    public function supplier(): BelongsTo
    {
    return $this->belongsTo(Supplier::class);
    }

    public function user(): BelongsTo
    {
    return $this->belongsTo(User::class);
    }

    public function detailBarangMasuk(): HasMany
    {
    return $this->hasMany(DetailBarangMasuk::class);
    }
}