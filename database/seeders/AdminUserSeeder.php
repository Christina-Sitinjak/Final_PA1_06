<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Periksa apakah admin sudah ada. Jika sudah, jangan buat lagi.
        if (User::where('email', 'admin@example.com')->exists()) {
            $this->command->info('Admin user already exists, skipping.');
            return;
        }

        User::create([
            'name' => 'Administrator',
            'email' => 'adminuec@gmail.com',
            'phone_number' => '', // Ganti dengan nomor telepon yang sesuai
            'password' => Hash::make('ueclaguboti'), // Ganti 'password' dengan password yang lebih kuat
            'role' => 'admin',
        ]);

        $this->command->info('Admin user created successfully.');
    }
}
