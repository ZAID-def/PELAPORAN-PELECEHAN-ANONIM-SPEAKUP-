<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // =============================================
        // AKUN SUPER ADMIN (Paling tinggi hak akses)
        // =============================================
        User::updateOrCreate(
            ['email' => 'superadmin@speakup.test'],
            [
                'name'     => 'Super Admin SpeakUp',
                'password' => Hash::make('password123'), // Ganti password ini!
                'role'     => 'super_admin',
                'email_verified_at' => now(),
            ]
        );

        // =============================================
        // AKUN ADMIN BIASA (untuk testing)
        // =============================================
        User::updateOrCreate(
            ['email' => 'admin@speakup.test'],
            [
                'name'     => 'Admin SpeakUp',
                'password' => Hash::make('password123'),
                'role'     => 'admin',
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('Akun Admin berhasil dibuat!');
        $this->command->warn('Email Super Admin : superadmin@speakup.test');
        $this->command->warn('Password          : password123');
    }
}