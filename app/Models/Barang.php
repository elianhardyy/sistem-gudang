<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barangs';

    protected $fillable = [
        'nama_barang',
        'kode',
        'stok',
        'deskripsi',
        'harga',
        'tanggal_masuk',
        'supplier_id',
        'kategori_id',
        'lokasi_id'
    ];

    // Relasi ke model Supplier (many to one)
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    // Relasi ke model Kategori (many to one)
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    // Relasi ke model Lokasi (many to one)
    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'lokasi_id');
    }

    public function mutasis()
    {
        return $this->hasMany(Mutasi::class,'barang_id');
    }
}
