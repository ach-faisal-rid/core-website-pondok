<?php

namespace Database\Seeders;

use App\Enums\PublishStatus;
use App\Enums\UserRole;
use App\Models\Category;
use App\Models\Content;
use App\Models\Setting;
use App\Models\User;
use App\Services\SettingService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@pondok.test'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password'),
                'role' => UserRole::Admin,
                'email_verified_at' => now(),
            ]
        );

        User::query()->updateOrCreate(
            ['email' => 'editor@pondok.test'],
            [
                'name' => 'Editor',
                'password' => Hash::make('password'),
                'role' => UserRole::Editor,
                'email_verified_at' => now(),
            ]
        );

        $defaults = [
            'site_name' => ['Pondok Pesantren Digital', 'site'],
            'site_tagline' => ['Membangun generasi berilmu, berakhlak, dan siap berkhidmat untuk umat.', 'site'],
            'logo' => [null, 'site'],
            'favicon' => [null, 'site'],
            'footer_text' => ['© '.date('Y').' Pondok Pesantren Digital. Semua hak dilindungi.', 'site'],
            'seo_title' => ['Pondok Pesantren Digital', 'seo'],
            'seo_description' => ['Website resmi profil pondok pesantren.', 'seo'],
            'phone' => ['+62 341 1234567', 'contact'],
            'whatsapp' => ['+62 812 3456 7890', 'contact'],
            'email' => ['info@pondok-digital.sch.id', 'contact'],
            'address' => ["Jl. Pendidikan No. 1, Kota Pendidikan,\nJawa Timur, Indonesia", 'contact'],
            'maps_embed' => [null, 'contact'],
            'facebook' => [null, 'social'],
            'instagram' => [null, 'social'],
            'youtube' => [null, 'social'],
            'profil_hero_subtitle' => ['Menelusuri jejak para ulama dan generasi yang kokoh dalam iman, ilmu, dan akhlak.', 'profil'],
            'profil_visi' => ['Menjadi lembaga pendidikan Islam yang unggul dalam mencetak generasi berilmu, berakhlak, dan bermanfaat bagi umat.', 'profil'],
            'pengasuh_1_name' => ['K.H. Abdullah bin Muhammad', 'profil'],
            'pengasuh_1_title' => ['Pengasuh Utama', 'profil'],
            'pengasuh_2_name' => ['Ny. Hj. Siti Aminah', 'profil'],
            'pengasuh_2_title' => ['Ketua Pondok Putri', 'profil'],
        ];

        foreach ($defaults as $key => [$value, $group]) {
            Setting::query()->updateOrCreate(
                ['key' => $key],
                ['value' => $value, 'group' => $group]
            );
        }

        app(SettingService::class)->forget();

        foreach (['Akademik', 'Kegiatan', 'Prestasi', 'Opini'] as $categoryName) {
            Category::query()->updateOrCreate(
                ['slug' => Str::slug($categoryName)],
                ['name' => $categoryName]
            );
        }

        $pages = [
            ['title' => 'Tentang Kami', 'slug' => 'tentang-kami'],
            ['title' => 'Profil Pondok', 'slug' => 'profil-pondok'],
            ['title' => 'Sejarah', 'slug' => 'sejarah'],
            ['title' => 'Visi & Misi', 'slug' => 'visi-misi'],
            ['title' => 'Struktur Organisasi', 'slug' => 'struktur-organisasi'],
        ];

        foreach ($pages as $page) {
            $body = match ($page['slug']) {
                'sejarah' => '<p>Berdiri dari kepedulian para ulama untuk menjaga warisan ilmu dan adab. Majelis kecil tumbuh menjadi komplek pendidikan yang kokoh, dijaga dengan ketulusan dan komitmen membentuk insan yang bermanfaat.</p><p>Semangat itu terus hidup dalam kegiatan belajar, mengaji, dan berkhidmat kepada masyarakat.</p>',
                default => '<p>Konten '.$page['title'].' akan diisi melalui panel admin.</p>',
            };

            Content::query()->updateOrCreate(
                ['slug' => $page['slug']],
                [
                    'title' => $page['title'],
                    'body' => $body,
                    'type' => 'page',
                    'status' => PublishStatus::Published,
                    'seo_title' => $page['title'],
                    'seo_description' => $page['title'].' — Pondok Pesantren',
                ]
            );
        }

        $this->call(HelpArticleSeeder::class);
    }
}
