<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokAwal extends Model
{
    use HasFactory;

    protected $table = 'stok_awal';

    protected $fillable = [
        'barang_id',
        'qty_stok',
        'tgl_input'
    ];

    public function StokBarang()
    {
        return $this->belongsTo(Barang::class, 'barang_id', 'id');
    }
}
