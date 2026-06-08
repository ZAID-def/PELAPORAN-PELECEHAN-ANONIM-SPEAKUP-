<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Membuat akun admin default untuk SpeakUp.
     */
    public function run(): void
    {
        // Super Admin
        User::updateOrCreate(
            ['email' => 'superadmin@speakup.com'],
            [
                'name'     => 'Super Admin',
                'email'    => 'superadmin@speakup.com',
                'password' => Hash::make('superadmin123'),
                'role'     => 'super_admin',
            ]
        );

        // Admin biasa
        User::updateOrCreate(
            ['email' => 'admin@speakup.id'],
            [
                'name'     => 'Admin SpeakUp',
                'email'    => 'admin@speakup.id',
                'password' => Hash::make('admin123'),
                'role'     => 'admin',
            ]
        );

        $this->command->info('✅ Akun admin berhasil dibuat!');
        $this->command->table(
            ['Role', 'Email', 'Password'],
            [
                ['Super Admin', 'superadmin@speakup.com', 'superadmin123'],
                ['Admin',       'admin@speakup.id',      'admin123'],
            ]
        );
    }
}
