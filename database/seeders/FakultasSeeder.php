<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fakultas;

class FakultasSeeder extends Seeder
{
    public function run(): void
    {
        $fakultasList = [
            ['kode_fakultas' => 'FIB', 'nama_fakultas' => 'Fakultas Ilmu Budaya'],
            ['kode_fakultas' => 'FK', 'nama_fakultas' => 'Fakultas Kedokteran'],
            ['kode_fakultas' => 'FH', 'nama_fakultas' => 'Fakultas Hukum'],
            ['kode_fakultas' => 'FT', 'nama_fakultas' => 'Fakultas Teknik'],
            ['kode_fakultas' => 'FP', 'nama_fakultas' => 'Fakultas Pertanian'],
            ['kode_fakultas' => 'FEB', 'nama_fakultas' => 'Fakultas Ekonomi dan Bisnis'],
            ['kode_fakultas' => 'FAPET', 'nama_fakultas' => 'Fakultas Peternakan'],
            ['kode_fakultas' => 'FMIPA', 'nama_fakultas' => 'Fakultas Matematika dan Ilmu Pengetahuan Alam'],
            ['kode_fakultas' => 'FKH', 'nama_fakultas' => 'Fakultas Kedokteran Hewan'],
            ['kode_fakultas' => 'FTP', 'nama_fakultas' => 'Fakultas Teknologi Pertanian'],
            ['kode_fakultas' => 'FPAR', 'nama_fakultas' => 'Fakultas Pariwisata'],
            ['kode_fakultas' => 'FISIP', 'nama_fakultas' => 'Fakultas Ilmu Sosial dan Ilmu Politik'],
            ['kode_fakultas' => 'FKP', 'nama_fakultas' => 'Fakultas Kelautan dan Perikanan'],
        ];

        foreach ($fakultasList as $fakultas) {
            Fakultas::create($fakultas);
        }
    }
}
