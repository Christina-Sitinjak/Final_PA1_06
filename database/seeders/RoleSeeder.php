<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Buat role jika belum ada
        $admin = Role::firstOrCreate(['nama_role' => 'admin']);
        $murid = Role::firstOrCreate(['nama_role' => 'murid']);

        // Assign role ke user admin berdasarkan email
        User::where('email', 'admin@example.com')->update(['role_id' => $admin->id]);

        // HAPUS baris yang mengakses kolom 'role' karena sudah tidak ada
        // User::where('role', 'admin')->update(['role_id' => $admin->id]);
        // User::where('role', 'murid')->update(['role_id' => $murid->id]);
    }
}
