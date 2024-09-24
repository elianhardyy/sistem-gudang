<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_supplier' => $this->faker->company, // Nama supplier acak
            'kontak' => $this->faker->phoneNumber, // Kontak supplier acak
            'alamat' => $this->faker->address, // Alamat supplier acak
            'email' => $this->faker->unique()->safeEmail,
        ];
    }
}
