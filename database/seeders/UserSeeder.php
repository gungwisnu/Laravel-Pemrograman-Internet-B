<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $passwordPlain = 'admin123';
        $now = Carbon::now();

        // Admin accounts (role = 'admin')
        $admins = [
            ['name' => 'Admin A', 'email' => 'admin@gmail.com'],
            ['name' => 'Admin B', 'email' => 'admin@a.com'],
            ['name' => 'Admin C', 'email' => 'admin@a.id'],
            ['name' => 'Admin D', 'email' => 'admin@a.a'],
            ['name' => 'Admin E', 'email' => 'a@a.com'],
            ['name' => 'Admin: Anak Agung Gede Wisnu Mahadhiva', 'email' => 'a@a.id'],
        ];

        foreach ($admins as $a) {
            User::updateOrCreate(
                ['email' => $a['email']],
                [
                    'name' => $a['name'],
                    'email' => $a['email'],
                    'password' => Hash::make($passwordPlain),
                    'role' => 'admin',
                    'email_verified_at' => $now,
                    'remember_token' => Str::random(10),
                ]
            );
        }

        // Regular user accounts (role = 'user')
        $users = [
            ['name' => 'User', 'email' => 'user@gmail.com'],
            ['name' => 'Anak Agung Gede Wisnu Mahadhiva', 'email' => 'gungwisnuuu@gmail.com'],
            ['name' => 'Gung Wisnu', 'email' => 'gungwisnu@gmail.com'],
            ['name' => 'Gungde', 'email' => 'gung@gmail.com'],
            ['name' => 'Wisnu', 'email' => 'wisnu@gmail.com'],
            ['name' => 'Anak Agung Gede Wisnu Mahadhiva', 'email' => 'asli@asli.id'],
            
        ];

        foreach ($users as $u) {
            User::updateOrCreate(
                ['email' => $u['email']],
                [
                    'name' => $u['name'],
                    'email' => $u['email'],
                    'password' => Hash::make($passwordPlain),
                    'role' => 'user',
                    'email_verified_at' => $now,
                    'remember_token' => Str::random(10),
                ]
            );
        }
    }
}
