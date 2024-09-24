<?php

namespace Database\Factories;

use App\Models\Kategori;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Barang>
 */
class BarangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $kategori = Kategori::factory()->create();

        // // Tentukan awalan kode berdasarkan kategori
        // $kodePrefix = '';
        // switch ($kategori->nama_kategori) {
        //     case 'Elektronik':
        //         $kodePrefix = 'ELC';
        //         break;
        //     case 'Pakaian':
        //         $kodePrefix = 'CLT';
        //         break;
        //     default:
        //         $kodePrefix = 'BRG';
        // }
        return [
            // 'nama_barang' => $this->faker->word,
            // 'kode' => $this->faker->unique()->bothify($kodePrefix.'###'),
            // 'stok' => $this->faker->numberBetween(10, 100),
            // 'deskripsi' => $this->faker->sentence,
            // 'harga' => $this->faker->numberBetween(10000, 10000000),
            // 'tanggal_masuk' => $this->faker->date(),
            // 'kategori_id'=>\App\Models\Kategori::factory(),
            // 'supplier_id'=>\App\Models\Supplier::factory(),
            // 'lokasi_id'=>\App\Models\Lokasi::factory(),
        ];
    }
}
