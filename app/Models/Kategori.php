<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'kategoris';

    protected $fillable = [
        'nama_kategori',
        'kode_unik',
    ];

    // Relasi ke model Barang (one to many)
    public function barangs()
    {
        return $this->hasMany(Barang::class, 'kategori_id');
    }
}
