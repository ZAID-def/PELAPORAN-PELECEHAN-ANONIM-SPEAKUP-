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
        // Create Super Admin for testing
        User::firstOrCreate(
            ['email' => 'superadmin@test.com'],
            [
                'name' => 'Super Admin Test',
                'password' => Hash::make('password'),
                'role' => 'super_admin',
            ]
        );

        // Create Regular Admin for testing
        User::firstOrCreate(
            ['email' => 'admin@test.com'],
            [
                'name' => 'Admin Test',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );
    }
}