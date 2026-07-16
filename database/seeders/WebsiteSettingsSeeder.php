<?php

namespace Database\Seeders;

use App\Services\SettingService;
use Illuminate\Database\Seeder;

class WebsiteSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = app(SettingService::class);

        $settings->setMany([
            'site_name' => 'Pondok Pesantren Digital',
            'site_tagline' => 'Membangun generasi berilmu, berakhlak, dan siap berkhidmat untuk umat.',
            'footer_text' => '© '.date('Y').' Pondok Pesantren Digital. Semua hak dilindungi.',
            'theme_primary' => '#134535',
            'theme_secondary' => '#1f6b4f',
        ], 'theme');

        // Jangan timpa logo/favicon yang sudah diunggah operator.
        if (! filled($settings->get('logo'))) {
            $settings->set('logo', '', 'theme');
        }
        if (! filled($settings->get('favicon'))) {
            $settings->set('favicon', '', 'theme');
        }
        $settings->setMany([
            'seo_title' => 'Pondok Pesantren Digital',
            'seo_description' => 'Website resmi profil pondok pesantren — berita, galeri, unduhan, dan informasi kontak.',
        ], 'seo');

        $settings->setMany([
            'phone' => '+62 341 1234567',
            'whatsapp' => '+62 812 3456 7890',
            'email' => 'info@pondok-digital.sch.id',
            'address' => "Jl. Pendidikan No. 1, Kota Pendidikan,\nJawa Timur, Indonesia",
            'maps_embed' => '',
        ], 'contact');

        $settings->setMany([
            'facebook' => 'https://facebook.com',
            'instagram' => 'https://instagram.com',
            'youtube' => 'https://youtube.com',
        ], 'social');

        $settings->setMany([
            'home_hero_title' => config('pondok.home.hero_title'),
            'home_hero_subtitle' => config('pondok.home.hero_subtitle'),
            'home_cta1_label' => 'Jelajahi Profil',
            'home_cta1_url' => '/profil',
            'home_cta2_label' => 'Hubungi Kami',
            'home_cta2_url' => '/kontak',
            'home_hero' => '',
            'home_panca_intro' => 'Lima nilai yang menjadi napas kehidupan santri dalam belajar, berkarya, dan berkhidmat.',
            'home_stats' => [
                ['value' => '1000+', 'label' => 'Santri Aktif', 'icon' => 'users'],
                ['value' => '40+ Tahun', 'label' => 'Pengabdian Pendidikan', 'icon' => 'calendar'],
                ['value' => '10+ Cabang', 'label' => 'Di Seluruh Indonesia', 'icon' => 'building'],
            ],
        ], 'home');

        $settings->setMany([
            'tentang_title' => 'Tentang Pondok',
            'tentang_body' => '<p>Pondok Pesantren Digital adalah lembaga pendidikan Islam yang menumbuhkan santri berilmu, beradab, dan siap berkhidmat di tengah perubahan zaman.</p><p>Melalui pendidikan diniyah dan formal yang terpadu, kami menjaga warisan ulama sekaligus membuka ruang pembelajaran yang relevan dengan kebutuhan umat.</p>',
            'profil_hero_subtitle' => config('pondok.profil.hero_subtitle'),
            'profil_hero' => '',
            'profil_founder_photo' => '',
            'profil_visi' => config('pondok.profil.visi'),
            'profil_misi' => config('pondok.profil.misi'),
            'profil_motto' => 'Berilmu, beradab, dan bermanfaat.',
            'profil_nilai' => 'Nilai pondok dijaga melalui adab, keikhlasan, dan keteladanan dalam belajar serta berkhidmat.',
            'panca_section_title' => 'Panca Jiwa Pondok',
            'profil_panca_jiwa' => config('pondok.profil.panca_jiwa'),
            'pengasuh_1_name' => 'K.H. Abdullah bin Muhammad',
            'pengasuh_1_title' => 'Pengasuh Utama',
            'pengasuh_1_sambutan' => 'Assalamu\'alaikum warahmatullahi wabarakatuh. Selamat datang di website resmi pondok kami. Semoga informasi di sini bermanfaat dan menjadi jembatan silaturahmi bagi wali santri, alumni, dan masyarakat luas.',
            'pengasuh_1_photo' => '',
            'pengasuh_2_name' => 'Ny. Hj. Siti Aminah',
            'pengasuh_2_title' => 'Ketua Pondok Putri',
            'pengasuh_2_sambutan' => 'Kami berkomitmen mendampingi santriwati agar tumbuh dalam ilmu, adab, dan kemandirian. Mari bersama menjaga amanah pendidikan yang penuh berkah.',
            'pengasuh_2_photo' => '',
        ], 'profil');

        $settings->set('website_nav', [
            ['label' => 'Beranda', 'url' => '/'],
            ['label' => 'Profil', 'url' => '/profil'],
            ['label' => 'Berita', 'url' => '/artikel'],
            ['label' => 'Galeri', 'url' => '/galeri'],
            ['label' => 'Unduhan', 'url' => '/download'],
            ['label' => 'Kontak', 'url' => '/kontak'],
        ], 'website');
    }
}
