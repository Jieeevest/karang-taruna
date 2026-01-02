<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('roles')->insert([
            [
                'name' => 'Ketua',
                'slug' => 'ketua',
                'description' => 'Ketua Karang Taruna dengan akses penuh',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Anggota',
                'slug' => 'anggota',
                'description' => 'Anggota Karang Taruna',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Admin Data',
                'slug' => 'admin-data',
                'description' => 'Administrator pengelola data',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Masyarakat',
                'slug' => 'masyarakat',
                'description' => 'Masyarakat umum (akses publik)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
