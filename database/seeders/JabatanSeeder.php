<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JabatanSeeder extends Seeder
{
    public function run()
    {
DB::table('jabatan')->insert([
[
                'nama_jabatan' => 'Manajer',
                'kode_jabatan' => 'MGR',
                'deskripsi' => 'Bertanggung jawab atas seluruh operasional showroom',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_jabatan' => 'Sales/Marketing',
                'kode_jabatan' => 'SLS',
                'deskripsi' => 'Menangani penjualan dan pemasaran mobil',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_jabatan' => 'Admin',
                'kode_jabatan' => 'ADM',
                'deskripsi' => 'Bertanggung jawab mengelola sistem showroom',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_jabatan' => 'Mekanik',
                'kode_jabatan' => 'MKK',
                'deskripsi' => 'Menangani pengecekan dan perawatan mobil',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}