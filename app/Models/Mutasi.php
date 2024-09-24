<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mutasi extends Model
{
    use HasFactory;

    protected $table = 'mutasis';

    protected $fillable = [
        'user_id',
        'barang_id',
        'lokasi_asal_id',
        'lokasi_tujuan_id',
        'tanggal',
        'jenis_mutasi',
        'jumlah',
        'keterangan'
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    // Relasi ke model Kategori (many to one)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function lokasiAsal()
    {
        return $this->belongsTo(Lokasi::class,'lokasi_asal_id');
    }
    public function lokasiTujuan()
    {
        return $this->belongsTo(Lokasi::class,'lokasi_tujuan_id');
    }
}
