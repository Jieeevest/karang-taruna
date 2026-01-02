<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['name' => 'Sosial', 'slug' => 'sosial', 'type' => 'activity', 'description' => 'Kegiatan sosial kemasyarakatan'],
            ['name' => 'Pendidikan', 'slug' => 'pendidikan', 'type' => 'activity', 'description' => 'Kegiatan pendidikan dan pelatihan'],
            ['name' => 'Olahraga', 'slug' => 'olahraga', 'type' => 'activity', 'description' => 'Kegiatan olahraga dan kesehatan'],
            ['name' => 'Budaya', 'slug' => 'budaya', 'type' => 'activity', 'description' => 'Kegiatan seni dan budaya'],
            ['name' => 'Lingkungan', 'slug' => 'lingkungan', 'type' => 'activity', 'description' => 'Kegiatan peduli lingkungan'],
            
            ['name' => 'Laporan', 'slug' => 'laporan', 'type' => 'document', 'description' => 'Dokumen laporan kegiatan'],
            ['name' => 'Proposal', 'slug' => 'proposal', 'type' => 'document', 'description' => 'Dokumen proposal kegiatan'],
            ['name' => 'Surat', 'slug' => 'surat', 'type' => 'document', 'description' => 'Surat menyurat organisasi'],
            
            ['name' => 'Berita', 'slug' => 'berita', 'type' => 'content', 'description' => 'Berita organisasi'],
            ['name' => 'Pengumuman', 'slug' => 'pengumuman', 'type' => 'content', 'description' => 'Pengumuman penting'],
            ['name' => 'Artikel', 'slug' => 'artikel', 'type' => 'content', 'description' => 'Artikel dan opini'],
        ];

        foreach ($categories as $category) {
            \DB::table('categories')->insert(array_merge($category, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
