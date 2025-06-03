<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Cek apakah role admin sudah ada
        $adminRole = Role::where('nama_role', 'admin')->first();

        if (!$adminRole) {
            $this->command->error('Role "admin" tidak ditemukan. Pastikan RoleSeeder sudah dijalankan.');
            return;
        }

        // Jika admin sudah ada, lewati pembuatan admin baru
        if (User::where('email', 'adminuec@gmail.com')->exists()) {
            $this->command->info('Admin user already exists, skipping.');
            return;
        }

        // Membuat user admin
        User::create([
            'name' => 'Administrator',
            'email' => 'adminuec@gmail.com',
            'phone_number' => '',
            'password' => Hash::make('ueclaguboti'),
            'role_id' => $adminRole->id, // Menggunakan ID role admin
        ]);

        $this->command->info('Admin user created successfully.');
    }
}
