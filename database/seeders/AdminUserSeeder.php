<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pegawai::updateOrCreate(
            ['nama' => 'admin'],
            [
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin'),
                'notelp' => '08123456789',
                'Role' => 'Admin',
            ]
        );

        Pegawai::updateOrCreate(
            ['nama' => 'user'],
            [
                'email' => 'user@gmail.com',
                'password' => Hash::make('user'),
                'notelp' => '08987654321',
                'Role' => 'User',
            ]
        );
    }
}
