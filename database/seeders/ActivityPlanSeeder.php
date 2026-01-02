<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{ActivityPlan, Category};
use Carbon\Carbon;

class ActivityPlanSeeder extends Seeder
{
    public function run()
    {
        $categories = Category::all();
        
        if ($categories->isEmpty()) {
            $this->command->warn('No categories found. Please run CategorySeeder first.');
            return;
        }

        $activities = [
            [
                'user_id' => 1, // Default admin user
                'title' => 'Bakti Sosial ke Panti Asuhan',
                'description' => 'Kegiatan bakti sosial memberikan bantuan dan hiburan kepada anak-anak panti asuhan. Meliputi pemberian sembako, perlengkapan sekolah, dan mengadakan games bersama.',
                'planned_date' => Carbon::now()->addDays(15),
                'location' => 'Panti Asuhan Kasih Sayang, Jakarta Timur',
                'status' => 'approved',
                'category_id' => $categories->random()->id,
            ],
            [
                'user_id' => 1,
                'title' => 'Pelatihan Kewirausahaan untuk Pemuda',
                'description' => 'Workshop intensif tentang memulai bisnis, manajemen keuangan, digital marketing, dan strategi pengembangan usaha untuk pemuda entrepreneur.',
                'planned_date' => Carbon::now()->addDays(30),
                'location' => 'Gedung Serbaguna RW 05',
                'status' => 'approved',
                'category_id' => $categories->random()->id,
            ],
            [
                'user_id' => 1,
                'title' => 'Festival Seni dan Budaya Daerah',
                'description' => 'Pentas seni dan budaya menampilkan tarian tradisional, musik daerah, pameran kerajinan tangan, dan kuliner khas sebagai upaya pelestarian budaya lokal.',
                'planned_date' => Carbon::now()->addMonths(2),
                'location' => 'Lapangan Desa',
                'status' => 'approved',
                'category_id' => $categories->random()->id,
            ],
            [
                'user_id' => 1,
                'title' => 'Donor Darah Bersama PMI',
                'description' => 'Kegiatan donor darah bekerjasama dengan PMI untuk membantu ketersediaan stok darah di rumah sakit dan menolong sesama.',
                'planned_date' => Carbon::now()->subMonths(1),
                'location' => 'Balai RW, Jakarta',
                'status' => 'approved',
                'category_id' => $categories->random()->id,
            ],
            [
                'user_id' => 1,
                'title' => 'Turnamen Futsal Antar RT',
                'description' => 'Kompetisi olahraga futsal antar RT untuk mempererat silaturahmi, menumbuhkan sportivitas, dan mengembangkan bakat olahraga pemuda.',
                'planned_date' => Carbon::now()->subMonths(2),
                'location' => 'Lapangan Futsal Pemuda',
                'status' => 'approved',
                'category_id' => $categories->random()->id,
            ],
            [
                'user_id' => 1,
                'title' => 'Gerakan Bersih Lingkungan',
                'description' => 'Got ong royong membersihkan lingkungan, pengangkatan sampah di sungai, dan penanaman pohon untuk menjaga kelestarian lingkungan hidup.',
                'planned_date' => Carbon::now()->subWeeks(2),
                'location' => 'Kawasan Sungai dan Taman Kota',
                'status' => 'approved',
                'category_id' => $categories->random()->id,
            ],
        ];

        foreach ($activities as $activity) {
            ActivityPlan::create($activity);
        }
    }
}
