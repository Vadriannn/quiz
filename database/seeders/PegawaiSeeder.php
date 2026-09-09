<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataku = 
        [
            ['nama' => 'David', 'email' => 'david@gmail.com', 'notelp' => '085158883003'],
            ['nama' => 'Jeremy', 'email' => 'jeremy@gmail.com', 'notelp' => '082142903507'],
            ['nama' => 'Vern', 'email' => 'vern@gmail.com', 'notelp' => '085121802250'],
        ];

        DB::table('pegawais')->insert($dataku);
    }
}
