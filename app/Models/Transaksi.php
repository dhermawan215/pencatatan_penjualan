<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = [
        'no_transaksi',
        'tanggal',
        'pembeli',
        'alamat',
        'total',
        'dilayani_oleh'
    ];

    public function Transkasis()
    {
        return $this->hasMany(TransaksiDetail::class, 'transaksi_id', 'id');
    }
}
