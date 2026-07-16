<?php

namespace Database\Seeders;

use App\Models\OrganizationMember;
use Illuminate\Database\Seeder;

class OrganizationMemberSeeder extends Seeder
{
    public function run(): void
    {
        $members = [
            [
                'name' => 'K.H. Abdullah bin Muhammad',
                'title' => 'Pengasuh Utama',
                'sort_order' => 1,
                'bio' => 'Pengasuh pondok yang membina santri dalam ilmu dan adab.',
            ],
            [
                'name' => 'Ny. Hj. Siti Aminah',
                'title' => 'Ketua Pondok Putri',
                'sort_order' => 2,
                'bio' => 'Membina pendidikan dan pembinaan santriwati.',
            ],
            [
                'name' => 'Ustadz Ahmad Fauzi',
                'title' => 'Kepala Madrasah',
                'sort_order' => 3,
                'bio' => 'Mengkoordinasikan kegiatan akademik diniyah dan formal.',
            ],
            [
                'name' => 'Ustadzah Fatimah Zahra',
                'title' => 'Kepala Bagian Kesantrian',
                'sort_order' => 4,
                'bio' => 'Menangani pembinaan kehidupan asrama dan kegiatan santri.',
            ],
            [
                'name' => 'Ustadz Rizki Maulana',
                'title' => 'Sekretaris Pondok',
                'sort_order' => 5,
                'bio' => 'Mengelola administrasi dan surat-menyurat lembaga.',
            ],
        ];

        foreach ($members as $member) {
            OrganizationMember::query()->updateOrCreate(
                [
                    'name' => $member['name'],
                    'title' => $member['title'],
                ],
                [
                    'sort_order' => $member['sort_order'],
                    'bio' => $member['bio'],
                    'photo' => null,
                    'parent_id' => null,
                ]
            );
        }
    }
}
