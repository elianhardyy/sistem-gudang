<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $table = 'suppliers';
    protected $fillable = [
        'nama_supplier',
        'kontak',
        'alamat',
        'email',
    ];

    // Relasi ke model Barang (one to many)
    public function barangs()
    {
        return $this->hasMany(Barang::class, 'supplier_id');
    }
}
