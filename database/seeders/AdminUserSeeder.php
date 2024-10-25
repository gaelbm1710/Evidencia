<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@halcon.com'],
            [
                'name' => 'Administrador',
                'password' => bcrypt('password'), // Cambia la contraseña por una segura
                'active' => true,
            ]
        );

        $admin->assignRole('Admin');
    }
}
