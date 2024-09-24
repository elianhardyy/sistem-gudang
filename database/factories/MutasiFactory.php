<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mutasi>
 */
class MutasiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'tanggal' => $this->faker->date(),
            // 'jenis_mutasi' => $this->faker->randomElement(['Pemasukan', 'Pengeluaran']),
            // 'jumlah' => $this->faker->numberBetween(1, 50),
            // 'user_id' => \App\Models\User::factory(),
            // 'barang_id' => \App\Models\Barang::factory(),
        ];
    }
}
