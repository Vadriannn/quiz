<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailNotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataku = [
            ['nota_id' => 1, 'barang_id' => 1, 'jumlah' => 2, 'subtotal' => 50000],
            ['nota_id' => 1, 'barang_id' => 2, 'jumlah' => 1, 'subtotal' => 20000],
            ['nota_id' => 2, 'barang_id' => 3, 'jumlah' => 3, 'subtotal' => 45000],
            ['nota_id' => 2, 'barang_id' => 4, 'jumlah' => 4, 'subtotal' => 60000],
            ['nota_id' => 3, 'barang_id' => 5, 'jumlah' => 5, 'subtotal' => 75000],
            ['nota_id' => 3, 'barang_id' => 6, 'jumlah' => 6, 'subtotal' => 90000],
        ];

        DB::table('detailnotas')->insert($dataku);
    }
}
