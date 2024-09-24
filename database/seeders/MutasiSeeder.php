<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\Mutasi;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MutasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();  // Ambil satu user untuk relasi
        $barang = Barang::first();  // Ambil satu barang untuk relasi

        Mutasi::create([
            'tanggal' => now(),
            'jenis_mutasi' => 'masuk',
            'jumlah' => 10,
            'lokasi_asal_id'=>1,
            'lokasi_tujuan_id'=>2,
            'user_id' => $user->id,   // Relasi dengan user
            'barang_id' => $barang->id,   // Relasi dengan barang
        ]);

        Mutasi::create([
            'tanggal' => now(),
            'jenis_mutasi' => 'keluar',
            'jumlah' => 5,
            'user_id' => $user->id,
            'lokasi_asal_id'=>2,
            'lokasi_tujuan_id'=>3,
            'barang_id' => $barang->id,
        ]);

        // Tambahkan lebih banyak mutasi jika diperlukan
        //Mutasi::factory(10)->create();
    }
}
