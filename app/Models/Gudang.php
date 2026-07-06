<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Gudang extends Model
{
    protected $table = 'gudang';

    protected $fillable = [
        'kode_gudang',
        'nama_gudang',
        'lokasi',
        'kapasitas',
        'keterangan'
    ];

    public function barang(): HasMany
    {
    return $this->hasMany(Barang::class);
    }
}