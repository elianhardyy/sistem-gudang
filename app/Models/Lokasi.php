<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    use HasFactory;

    protected $table = 'lokasis';

    protected $fillable = [
        'nama_lokasi',
        'deskripsi'
    ];

    // Relasi ke Barang (one to many)
    public function barangs()
    {
        return $this->hasMany(Barang::class, 'lokasi_id');
    }
    public function lokasiAsal()
    {
        return $this->hasMany(Mutasi::class,'lokasi_asal_id');
    }
    public function lokasiTujuan()
    {
        return $this->hasMany(Mutasi::class,'lokasi_tujuan_id');
    }
}
