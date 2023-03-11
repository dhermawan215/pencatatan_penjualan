<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'harga',
        'didaftarkan_oleh'
    ];

    public function Stoks()
    {
        return $this->hasMany(StokAwal::class, 'barang_id', 'id');
    }

    public function TransaksiDetails()
    {
        return $this->hasMany(TransaksiDetail::class, 'barang_id', 'id');
    }
}
