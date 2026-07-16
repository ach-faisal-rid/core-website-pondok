<?php

namespace Database\Seeders;

use App\Enums\PublishStatus;
use App\Enums\UserRole;
use App\Models\Category;
use App\Models\Content;
use App\Models\User;
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

        $this->call([
            WebsiteSettingsSeeder::class,
            OrganizationMemberSeeder::class,
            HelpArticleSeeder::class,
        ]);

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
    }
}
