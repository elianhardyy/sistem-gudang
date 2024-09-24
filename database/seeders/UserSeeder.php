<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            "remember_token"=>Str::random(10),
            'email_verified_at' => now(), 
        ])->assignRole('admin');
        User::create([
            'name' => 'Manager User',
            'email' => 'manager@example.com',
            'password' => Hash::make('password123'),
            "remember_token"=>Str::random(10),
            'email_verified_at' => now(), 
        ])->assignRole('manager');
        User::create([
            'name' => 'Karyawan User',
            'email' => 'karyawan@example.com',
            'password' => Hash::make('password123'),
            "remember_token"=>Str::random(10),
            'email_verified_at' => now(), 
        ])->assignRole('karyawan');
        User::create([
            'name' => 'Karyawan User 2',
            'email' => 'karyawan2@example.com',
            'password' => Hash::make('password123'),
            "remember_token"=>Str::random(10),
            'email_verified_at' => now(), 
        ])->assignRole('karyawan');

        // Tambahkan lebih banyak user jika diperlukan
        //User::factory(10)->create(); // Menggunakan factory untuk membuat 10 user tambahan
    }
}
