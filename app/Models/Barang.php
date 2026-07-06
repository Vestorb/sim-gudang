<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Barang extends Model
{
    protected $table = 'barang';

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'kategori_id',
        'supplier_id',
        'gudang_id',
        'stok',
        'stok_minimum',
        'satuan',
        'harga',
        'foto_barang',
        'status',
        'deskripsi'
    ];

    public function kategori(): BelongsTo
    {
    return $this->belongsTo(Kategori::class);
    }

    public function supplier(): BelongsTo
    {
    return $this->belongsTo(Supplier::class);
    }

    public function gudang(): BelongsTo
    {
    return $this->belongsTo(Gudang::class);
    }

    public function detailBarangMasuk(): HasMany
    {
    return $this->hasMany(DetailBarangMasuk::class);
    }

    public function detailBarangKeluar(): HasMany
    {
    return $this->hasMany(DetailBarangKeluar::class);
    }
}