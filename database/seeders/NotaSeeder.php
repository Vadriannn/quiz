<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataku = [
            ['tanggal' => '2026-01-01', 'metodepembayaran' => 'Tunai', 'pelanggan_id' => 1, 'pegawai_id' => 1],
            ['tanggal' => '2026-01-02', 'metodepembayaran' => 'QRIS', 'pelanggan_id' => 2, 'pegawai_id' => 2],
            ['tanggal' => '2026-01-03', 'metodepembayaran' => 'Transfer', 'pelanggan_id' => 3, 'pegawai_id' => 3],
        ];

        DB::table('notas')->insert($dataku);
    }
}
