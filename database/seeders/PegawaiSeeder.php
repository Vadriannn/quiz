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
        $dataku = [
            ['nama' => 'Vadrian', 'email' => 'vadrian@gmail.com', 'password' => bcrypt('password'), 'notelp' => '082122846448', 'Role' => 'Admin'],
            ['nama' => 'David', 'email' => 'david@gmail.com', 'password' => bcrypt('password'), 'notelp' => '085158883003', 'Role' => 'User'],
            ['nama' => 'Jeremy', 'email' => 'jeremy@gmail.com', 'password' => bcrypt('password'), 'notelp' => '082142903507', 'Role' => 'User'],
            ['nama' => 'Vern', 'email' => 'vern@gmail.com', 'password' => bcrypt('password'), 'notelp' => '085121802250', 'Role' => 'User'],
            
        ];

        DB::table('pegawais')->insert($dataku);
    }
}
