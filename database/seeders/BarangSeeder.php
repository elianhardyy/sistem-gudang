<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Barang::create([
            'nama_barang' => 'Laptop',
            'kode' => 'ELC123',
            'stok' => 50,
            'deskripsi' => 'Laptop berkualitas tinggi',
            'harga' => 10000000, // Harga dalam satuan Rupiah
            'tanggal_masuk'=>now(),
            'kategori_id'=>1,
            'supplier_id'=>1,
            'lokasi_id' => 1,
        ]);

        Barang::create([
            'nama_barang' => 'Smartphone',
            'kode' => 'ELC456',
            'stok' => 100,
            'deskripsi' => 'Smartphone terbaru dengan fitur canggih',
            'harga' => 5000000,
            'tanggal_masuk'=>now(),
            'kategori_id'=>1,
            'supplier_id'=>2,
            'lokasi_id' => 1,
        ]);

        Barang::create([
            'nama_barang' => 'Kaos Polos',
            'kode' => 'CLT002',
            'stok' => 100,
            'deskripsi' => 'Kaos polos warna hitam',
            'harga' => 50000,
            'tanggal_masuk' => now(),
            'kategori_id'=>2,
            'supplier_id'=>3,
            'lokasi_id' => 2,
        ]);

    }
}
