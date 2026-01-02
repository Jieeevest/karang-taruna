<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'Ketua Karang Taruna',
            'email' => 'ketua@karangtaruna.id',
            'password' => bcrypt('password'),
            'role_id' => 1, // Ketua
            'phone' => '081234567890',
            'is_active' => true,
        ]);

        \App\Models\User::create([
            'name' => 'Admin Data',
            'email' => 'admin@karangtaruna.id',
            'password' => bcrypt('password'),
            'role_id' => 3, // Admin Data
            'phone' => '081234567891',
            'is_active' => true,
        ]);

        \App\Models\User::create([
            'name' => 'Anggota Test',
            'email' => 'anggota@karangtaruna.id',
            'password' => bcrypt('password'),
            'role_id' => 2, // Anggota
            'phone' => '081234567892',
            'is_active' => true,
        ]);

        // Test users for Playwright E2E testing
        \App\Models\User::create([
            'name' => 'Ketua Test',
            'email' => 'ketua@karangtaruna.test',
            'password' => bcrypt('password'),
            'role_id' => 1, // Ketua
            'phone' => '081234567893',
            'is_active' => true,
        ]);

        \App\Models\User::create([
            'name' => 'Admin Test',
            'email' => 'admin@karangtaruna.test',
            'password' => bcrypt('password'),
            'role_id' => 3, // Admin Data
            'phone' => '081234567894',
            'is_active' => true,
        ]);

        \App\Models\User::create([
            'name' => 'Anggota Test',
            'email' => 'anggota@karangtaruna.test',
            'password' => bcrypt('password'),
            'role_id' => 2, // Anggota
            'phone' => '081234567895',
            'is_active' => true,
        ]);
    }
}
