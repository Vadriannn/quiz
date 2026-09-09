<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataku =
        [
            ['nama' => 'Timothy', 'email' => 'timothy@gmail.com', 'notelp' => '08123456789'],
            ['nama' => 'Kennan', 'email' => 'kennan@gmail.com', 'notelp' => '08123456789'],
            ['nama' => 'Nicolas', 'email' => 'nicolas@gmail.com', 'notelp' => '08123456789'],
        ];

        DB::table('pelanggans')->insert($dataku);
    }
}
