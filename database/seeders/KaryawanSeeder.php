<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KaryawanSeeder extends Seeder
{
    public function run()
    {
DB::table('karyawan')->insert([
            [
                'nama' => 'Tissa Alyssa',
                'nik' => 'MGR001',
                'email' => 'tissaaa@showroom.com',
                'alamat' => 'Jl. Sudirman No. 123, Jakarta',
                'no_telepon' => '08123456789',
                'kode_jabatan' => 'MGR', 
                'created_at' => now(),
                'updated_at' => now()
                
            ],
            [
                'nama' => 'Bejo Sibutarbutar',
                'nik' => 'SLS001',
                'email' => 'bejosibutarbutar@showroom.com',
                'alamat' => 'Jl. Welirang No. 17, Medan',
                'no_telepon' => '0814466432',
                'kode_jabatan' => 'SLS', 
                'created_at' => now(),
                'updated_at' => now()
                
            ],
            [
                'nama' => 'Rani Saraswati',
                'nik' => 'SLS002',
                'email' => 'rani1414@showroom.com',
                'alamat' => 'Jl. Soekarno No. 45, Yogyakarta',
                'no_telepon' => '086535286',
                'kode_jabatan' => 'SLS', 
                'created_at' => now(),
                'updated_at' => now()
                
            ],
            [
                'nama' => 'Milo Simanjutak',
                'nik' => 'ADM001',
                'email' => 'milosimanjutak17@showroom.com',
                'alamat' => 'Jl. Bunga Telang No. 67, Malang',
                'no_telepon' => '08123456789',
                'kode_jabatan' => 'ADM', 
                'created_at' => now(),
                'updated_at' => now()
                
            ],
            [
                'nama' => 'Kepin',
                'nik' => 'MKK001',
                'email' => 'kepintutttt1@showroom.com',
                'alamat' => 'Jl. Sidoarjo No. 23, Surabaya',
                'no_telepon' => '080987655',
                'kode_jabatan' => 'MKK', 
                'created_at' => now(),
                'updated_at' => now()
                
            ],
            [
                'nama' => 'Bagaskara',
                'nik' => 'MKK002',
                'email' => 'bagas1920@showroom.com',
                'alamat' => 'Jl. Watu Gong No. 70, Surabaya',
                'no_telepon' => '0898765433',
                'kode_jabatan' => 'MKK', 
                'created_at' => now(),
                'updated_at' => now()
                
            ],
        ]);
    }
}