<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Jalankan semua seeder utama aplikasi.
     */
    public function run(): void
    {
        // Jalankan semua seeder yang dibutuhkan
        $this->call([
            UserSeeder::class,
            FakultasSeeder::class,
            ProdiSeeder::class,
            MahasiswaSeeder::class,
        ]);

        // (Opsional) bisa tambah factory jika mau generate dummy user tambahan
        // \App\Models\User::factory(5)->create();
    }
}
