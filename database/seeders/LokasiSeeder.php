<?php

namespace Database\Seeders;

use App\Models\Lokasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LokasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Lokasi::create([
            "nama_lokasi"=>"Gudang A",
            "deskripsi"=>"Gudang cabang untuk distribusi di wilayah A"
        ]);
        Lokasi::create([
            "nama_lokasi"=>"Gudang B",
            "deskripsi"=>"Gudang cabang untuk distribusi di wilayah B"
        ]);
        Lokasi::create([
            "nama_lokasi"=>"Gudang C",
            "deskripsi"=>"Gudang cabang untuk distribusi di wilayah C"
        ]);
    }
}
