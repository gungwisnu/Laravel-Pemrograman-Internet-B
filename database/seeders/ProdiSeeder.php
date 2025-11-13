<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Prodi;
use App\Models\Fakultas;

class ProdiSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            // Fakultas Teknik
            ['kode_prodi' => '23201', 'nama_prodi' => 'Arsitektur', 'fakultas' => 'Fakultas Teknik'],
            ['kode_prodi' => '20201', 'nama_prodi' => 'Teknik Elektro', 'fakultas' => 'Fakultas Teknik'],
            ['kode_prodi' => '22201', 'nama_prodi' => 'Teknik Sipil', 'fakultas' => 'Fakultas Teknik'],
            ['kode_prodi' => '21201', 'nama_prodi' => 'Teknik Mesin', 'fakultas' => 'Fakultas Teknik'],
            ['kode_prodi' => '59201', 'nama_prodi' => 'Teknologi Informasi', 'fakultas' => 'Fakultas Teknik'],
            ['kode_prodi' => '352045', 'nama_prodi' => 'Teknik Lingkungan', 'fakultas' => 'Fakultas Teknik'],
            ['kode_prodi' => '26201', 'nama_prodi' => 'Teknik Industri', 'fakultas' => 'Fakultas Teknik'],

            // Fakultas Ilmu Budaya
            ['kode_prodi' => '79212', 'nama_prodi' => 'Sastra Bali', 'fakultas' => 'Fakultas Ilmu Budaya'],
            ['kode_prodi' => '79204', 'nama_prodi' => 'Sastra Jepang', 'fakultas' => 'Fakultas Ilmu Budaya'],

            // Fakultas Kedokteran
            ['kode_prodi' => '11203', 'nama_prodi' => 'Kedokteran', 'fakultas' => 'Fakultas Kedokteran'],
            ['kode_prodi' => '73201', 'nama_prodi' => 'Psikologi', 'fakultas' => 'Fakultas Kedokteran'],

            // Fakultas Hukum
            ['kode_prodi' => '74201', 'nama_prodi' => 'Ilmu Hukum', 'fakultas' => 'Fakultas Hukum'],
            ['kode_prodi' => '74102', 'nama_prodi' => 'Kenotariatan', 'fakultas' => 'Fakultas Hukum'],

            // Fakultas Pertanian
            ['kode_prodi' => '54201', 'nama_prodi' => 'Agribisnis', 'fakultas' => 'Fakultas Pertanian'],
            ['kode_prodi' => '54214', 'nama_prodi' => 'Arsitektur Lanskap', 'fakultas' => 'Fakultas Pertanian'],

            // Fakultas Ekonomi dan Bisnis
            ['kode_prodi' => '61201', 'nama_prodi' => 'Manajemen', 'fakultas' => 'Fakultas Ekonomi dan Bisnis'],
            ['kode_prodi' => '87220', 'nama_prodi' => 'Ekonomi', 'fakultas' => 'Fakultas Ekonomi dan Bisnis'],

            // Fakultas Peternakan
            ['kode_prodi' => '54231', 'nama_prodi' => 'Peternakan', 'fakultas' => 'Fakultas Peternakan'],
            ['kode_prodi' => '54131', 'nama_prodi' => 'Ilmu Peternakan', 'fakultas' => 'Fakultas Peternakan'],

            // Fakultas MIPA
            ['kode_prodi' => '44201', 'nama_prodi' => 'Matematika', 'fakultas' => 'Fakultas Matematika dan Ilmu Pengetahuan Alam'],
            ['kode_prodi' => '55200', 'nama_prodi' => 'Informatika', 'fakultas' => 'Fakultas Matematika dan Ilmu Pengetahuan Alam'],

            // Fakultas Kedokteran Hewan
            ['kode_prodi' => '54268', 'nama_prodi' => 'Kedokteran Hewan', 'fakultas' => 'Fakultas Kedokteran Hewan'],
            ['kode_prodi' => '54961', 'nama_prodi' => 'Profesi Dokter Hewan', 'fakultas' => 'Fakultas Kedokteran Hewan'],

            // Fakultas Teknologi Pertanian
            ['kode_prodi' => '41221', 'nama_prodi' => 'Teknologi Pangan', 'fakultas' => 'Fakultas Teknologi Pertanian'],
            ['kode_prodi' => '80203', 'nama_prodi' => 'Teknik Pertanian dan Biosistem', 'fakultas' => 'Fakultas Teknologi Pertanian'],

            // Fakultas Pariwisata
            ['kode_prodi' => '93207', 'nama_prodi' => 'Pariwisata', 'fakultas' => 'Fakultas Pariwisata'],
            ['kode_prodi' => '93201', 'nama_prodi' => 'Industri Perjalanan Wisata', 'fakultas' => 'Fakultas Pariwisata'],

            // Fakultas Ilmu Sosial dan Ilmu Politik
            ['kode_prodi' => '84201', 'nama_prodi' => 'Hubungan Internasional', 'fakultas' => 'Fakultas Ilmu Sosial dan Ilmu Politik'],
            ['kode_prodi' => '67201', 'nama_prodi' => 'Ilmu Politik', 'fakultas' => 'Fakultas Ilmu Sosial dan Ilmu Politik'],

            // Fakultas Kelautan dan Perikanan
            ['kode_prodi' => '54242', 'nama_prodi' => 'Manajemen Sumberdaya Perairan', 'fakultas' => 'Fakultas Kelautan dan Perikanan'],
            ['kode_prodi' => '54250', 'nama_prodi' => 'Akuakultur', 'fakultas' => 'Fakultas Kelautan dan Perikanan'],
        ];

        foreach ($data as $item) {
            $fakultas = Fakultas::where('nama_fakultas', $item['fakultas'])->first();

            if ($fakultas) {
                Prodi::updateOrCreate(
                    ['kode_prodi' => $item['kode_prodi']],
                    [
                        'nama_prodi' => $item['nama_prodi'],
                        'fakultas_id' => $fakultas->id,
                    ]
                );
            }
        }
    }
}
