<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BarangKeluar extends Model
{
    protected $table = 'barang_keluar';

    protected $fillable = [
        'nomor_transaksi',
        'tanggal',
        'user_id',
        'tujuan',
        'status',
        'keterangan'
    ];

    public function user(): BelongsTo
    {
    return $this->belongsTo(User::class);
    }

    public function detailBarangKeluar(): HasMany
    {
    return $this->hasMany(DetailBarangKeluar::class);
    }
}