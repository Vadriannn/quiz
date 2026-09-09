<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $databarang = [
            ['nama' => 'Nasi Ayam Bakar', 'harga' => 25000, 'kategori_id' => 1, 'stok' => 10],
            ['nama' => 'Nasi Goreng Seafood', 'harga' => 20000, 'kategori_id' => 1, 'stok' => 15],
            ['nama' => 'Mie Goreng Spesial', 'harga' => 15000, 'kategori_id' => 1, 'stok' => 20],
            ['nama' => 'Kerupuk', 'harga' => 2000, 'kategori_id' => 2, 'stok' => 10],
            ['nama' => 'Es Teh', 'harga' => 3000, 'kategori_id' => 3, 'stok' => 25],
            ['nama' => 'Air Mineral', 'harga' => 3000, 'kategori_id' => 3, 'stok' => 30],
            ['nama' => 'Soft Drink', 'harga' => 5000, 'kategori_id' => 4, 'stok' => 30],
            ['nama' => 'Susu', 'harga' => 7000, 'kategori_id' => 5, 'stok' => 30],
        ];

        DB::table('barangs')->insert($databarang);
    }
}
