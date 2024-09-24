<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Supplier::create([
            'nama_supplier' => 'Supplier Elektronik', 
            'kontak' => '081234567890', 
            'alamat' => 'Jalan Mawar No. 1', 
            'email' => 'supplier1@elektronik.com'
        ]);
        Supplier::create([
            'nama_supplier' => 'Supplier Elektronik 2', 
            'kontak' => '081234567891', 
            'alamat' => 'Jalan Melati No. 2', 
            'email' => 'supplier2@elektronik.com'
        ]);
        Supplier::create([
            'nama_supplier' => 'Supplier Makanan', 
            'kontak' => '081234567892', 
            'alamat' => 'Jalan Anggrek No. 3', 
            'email' => 'supplier3@makanan.com'
        ]);
    }
}