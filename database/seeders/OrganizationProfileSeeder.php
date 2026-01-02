<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrganizationProfile;

class OrganizationProfileSeeder extends Seeder
{
    public function run()
    {
        OrganizationProfile::create([
            'organization_name' => 'Karang Taruna Indonesia',
            'about' => 'Karang Taruna adalah organisasi kepemudaan di Indonesia yang merupakan wadah pengembangan generasi muda yang tumbuh dan berkembang atas dasar kesadaran dan tanggung jawab sosial dari, oleh, dan untuk masyarakat terutama generasi muda. Karang Taruna berperan aktif dalam berbagai kegiatan pembangunan masyarakat dengan mengedepankan kepedulian, kreativitas, dan jiwa kepemimpinan para anggotanya.',
            'vision' => 'Terwujudnya generasi muda yang beriman, bertakwa, berakhlak mulia, sehat, cerdas, terampil, kreatif, inovatif, mandiri, demokratis, dan bertanggung jawab dalam membangun bangsa dan negara Indonesia yang adil, makmur, dan sejahtera.',
            'mission' => 'Menyelenggarakan pembinaan dan pemberdayaan generasi muda melalui berbagai kegiatan sosial, pendidikan, keterampilan, kewirausahaan, olahraga, seni, dan budaya untuk meningkatkan kualitas hidup dan kesejahteraan masyarakat.',
            'history' => 'Karang Taruna didirikan pada tahun 1960-an sebagai wadah pembinaan dan pengembangan generasi muda. Sejak saat itu, Karang Taruna terus berkembang dan aktif dalam berbagai kegiatan pembangunan masyarakat di seluruh Indonesia.',
            'address' => 'Jl. Pemuda No. 123, Jakarta Pusat, DKI Jakarta 10110',
            'phone' => '(021) 123-4567',
            'email' => 'info@karangtaruna.id',
            'social_media' => json_encode([
                'facebook' => 'https://facebook.com/karangtaruna',
                'instagram' => 'https://instagram.com/karangtaruna',
                'twitter' => 'https://twitter.com/karangtaruna',
                'youtube' => 'https://youtube.com/@karangtaruna'
            ])
        ]);
    }
}
