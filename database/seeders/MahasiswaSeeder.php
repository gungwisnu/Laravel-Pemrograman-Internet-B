<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;
use App\Models\Prodi;

class MahasiswaSeeder extends Seeder
{
    /**
     * Jalankan seeder mahasiswa.
     */
    public function run(): void
    {
        $data = [
            [
                'nim' => '2405551106',
                'nama' => 'Anak Agung Gede Wisnu Mahadhiva',
                'prodi' => 'Teknologi Informasi',
            ],
            [
                'nim' => '2405551053',
                'nama' => 'Ida Bagus Dio Gloria',
                'prodi' => 'Sastra Jepang',
            ],
            [
                'nim' => '2405551089',
                'nama' => 'I Nyoman Restu Dharmayasa',
                'prodi' => 'Matematika',
            ],
            [
                'nim' => '2405551150',
                'nama' => 'Jason Adriel Gerard Abidano',
                'prodi' => 'Pariwisata',
            ],
            [
                'nim' => '2405551098',
                'nama' => 'Dewa Made Pandu Diotama',
                'prodi' => 'Ilmu Hukum',
            ],
            [
                'nim' => '2405551026',
                'nama' => 'I Putu Raditya Dharma Yoga',
                'prodi' => 'Kedokteran',
            ],
            [
                'nim' => '2405551085',
                'nama' => 'I Gusti Bagus Rama Kusuma Vijaya',
                'prodi' => 'Manajemen',
            ],
            [
                'nim' => '2405551087',
                'nama' => 'Pande Putu Satya Naraya Adyana',
                'prodi' => 'Agribisnis',
            ],
        ];

        foreach ($data as $mhs) {
            $prodi = Prodi::where('nama_prodi', $mhs['prodi'])->first();

            if ($prodi) {
                Mahasiswa::create([
                    'nim' => $mhs['nim'],
                    'nama' => $mhs['nama'],
                    'prodi_id' => $prodi->id,
                ]);
            } else {
                $this->command->warn("⚠️ Prodi {$mhs['prodi']} tidak ditemukan, mahasiswa {$mhs['nama']} dilewati.");
            }
        }

        $this->command->info('✅ Seeder Mahasiswa berhasil dijalankan!');
    }
}
