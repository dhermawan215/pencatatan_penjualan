<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
    use HasFactory;

    protected $table = 'transaksi_detail';

    protected $fillable = [
        'transaksi_id',
        'barang_id',
        'harga_satuan',
        'qty',
        'sub_total'
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id', 'id');
    }

    public function TransaksiBarang()
    {
        return $this->belongsTo(Barang::class, 'barang_id', 'id');
    }
}
