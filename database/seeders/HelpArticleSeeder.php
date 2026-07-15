<?php

namespace Database\Seeders;

use App\Enums\HelpCategory;
use App\Models\HelpArticle;
use Illuminate\Database\Seeder;

class HelpArticleSeeder extends Seeder
{
    public function run(): void
    {
        $articles = [
            [
                'category' => HelpCategory::Umum,
                'sort_order' => 1,
                'title' => 'Perbedaan peran Admin dan Editor',
                'body' => '<p><strong>Administrator (Super Admin)</strong> dapat mengelola semua modul: Website, publikasi, pengguna, dan konten bantuan.</p><p><strong>Editor</strong> dapat mengelola Artikel, Galeri, Unduhan, Halaman, dan membaca Pesan Kontak — tetapi tidak dapat mengubah menu Website atau mengelola pengguna.</p>',
            ],
            [
                'category' => HelpCategory::Umum,
                'sort_order' => 2,
                'title' => 'Cara masuk dan keluar',
                'body' => '<ol><li>Buka halaman masuk di <code>/login</code>.</li><li>Masukkan email dan kata sandi akun Anda.</li><li>Setelah masuk, Anda diarahkan ke Dashboard admin.</li><li>Untuk keluar, klik ikon keluar di panel akun (bawah sidebar kiri).</li></ol>',
            ],
            [
                'category' => HelpCategory::Umum,
                'sort_order' => 3,
                'title' => 'Memahami menu sidebar admin',
                'body' => '<p>Sidebar dikelompokkan agar mudah dicari:</p><ul><li><strong>Website</strong> — kelola tampilan dan identitas situs (Hero, Tentang, Pengasuh, dll.).</li><li><strong>Publikasi</strong> — Artikel, Galeri, Unduhan, dan Halaman.</li><li><strong>Komunikasi</strong> — Pesan Kontak dari pengunjung.</li><li><strong>Sistem</strong> — Pengguna dan Bantuan.</li></ul>',
            ],
            [
                'category' => HelpCategory::Dashboard,
                'sort_order' => 1,
                'title' => 'Membaca ringkasan dashboard',
                'body' => '<p>Dashboard menampilkan jumlah halaman, artikel, album galeri, file unduhan, dan pesan kontak yang belum dibaca. Gunakan angka ini untuk memantau aktivitas situs secara cepat.</p>',
            ],
            [
                'category' => HelpCategory::Website,
                'sort_order' => 1,
                'title' => 'Apa itu menu Website?',
                'body' => '<p>Menu <strong>Website</strong> (hanya Admin) adalah pusat pengelolaan identitas dan tampilan website pondok. Setiap bagian punya halaman sendiri: Hero, Tentang Pondok, Pengasuh, Visi &amp; Misi, Panca Jiwa, Struktur Organisasi, Statistik, Navigasi, Footer, SEO, dan Tema.</p><p>Homepage publik menampilkan gabungan section tersebut — bukan data terpisah bernama “Homepage”.</p>',
            ],
            [
                'category' => HelpCategory::Website,
                'sort_order' => 2,
                'title' => 'Mengubah Hero dan Statistik beranda',
                'body' => '<ol><li>Buka <strong>Website → Hero</strong> untuk judul, subtitle, tombol, dan gambar latar beranda.</li><li>Buka <strong>Website → Statistik</strong> untuk angka ringkas (misalnya jumlah santri atau ustadz).</li><li>Simpan — perubahan langsung tampil di beranda publik.</li></ol>',
            ],
            [
                'category' => HelpCategory::Website,
                'sort_order' => 3,
                'title' => 'Mengelola Pengasuh, Visi &amp; Misi, dan Panca Jiwa',
                'body' => '<p>Gunakan submenu terkait di <strong>Website</strong>:</p><ul><li><strong>Pengasuh</strong> — nama, jabatan, foto, dan sambutan.</li><li><strong>Visi &amp; Misi</strong> — visi, daftar misi, motto, dan nilai.</li><li><strong>Panca Jiwa</strong> — butir nilai dengan ikon dan deskripsi.</li></ul>',
            ],
            [
                'category' => HelpCategory::Website,
                'sort_order' => 4,
                'title' => 'Struktur Organisasi',
                'body' => '<p>Buka <strong>Website → Struktur Organisasi</strong>. Tambahkan anggota dengan nama, jabatan, urutan, dan foto. Data ini tersimpan sebagai entitas tersendiri (bukan halaman Konten/Halaman).</p>',
            ],
            [
                'category' => HelpCategory::Website,
                'sort_order' => 5,
                'title' => 'Navigasi, Footer, SEO, dan Tema',
                'body' => '<ul><li><strong>Navigasi</strong> — label dan URL menu header/footer publik.</li><li><strong>Footer</strong> — tagline, teks footer, kontak, dan tautan sosial.</li><li><strong>SEO</strong> — judul dan deskripsi meta default.</li><li><strong>Tema</strong> — nama situs, logo, favicon, dan warna merek.</li></ul><p>Menu <strong>Pengaturan</strong> lama dialihkan ke <strong>Website → Tema</strong>.</p>',
            ],
            [
                'category' => HelpCategory::Halaman,
                'sort_order' => 1,
                'title' => 'Menambah halaman statis',
                'body' => '<ol><li>Buka <strong>Publikasi → Halaman</strong> → <strong>Tambah Halaman</strong>.</li><li>Isi judul, isi body, dan status publikasi.</li><li>Simpan — halaman dapat ditautkan dari profil atau menu Navigasi sesuai slug.</li></ol><p>Gunakan Halaman untuk sejarah panjang atau konten statis; untuk identitas visual beranda pakai menu Website.</p>',
            ],
            [
                'category' => HelpCategory::Artikel,
                'sort_order' => 1,
                'title' => 'Menerbitkan artikel berita',
                'body' => '<ol><li>Buka <strong>Publikasi → Artikel</strong> → <strong>Tambah Artikel</strong>.</li><li>Isi judul, kategori, isi, dan thumbnail (opsional).</li><li>Pilih status <strong>Terbit</strong> dan tanggal publikasi.</li><li>Simpan — artikel muncul di halaman Berita website.</li></ol>',
            ],
            [
                'category' => HelpCategory::Galeri,
                'sort_order' => 1,
                'title' => 'Membuat album galeri',
                'body' => '<ol><li>Buka <strong>Publikasi → Galeri</strong> → buat album baru.</li><li>Isi judul, kategori, dan deskripsi.</li><li>Unggah foto ke album tersebut.</li><li>Album akan tampil di halaman Galeri publik.</li></ol>',
            ],
            [
                'category' => HelpCategory::Unduhan,
                'sort_order' => 1,
                'title' => 'Menambah file unduhan',
                'body' => '<ol><li>Buka <strong>Publikasi → Unduhan</strong> → <strong>Tambah File</strong>.</li><li>Isi judul, kategori, deskripsi, dan unggah file.</li><li>Simpan — pengunjung dapat mengunduh dari halaman Unduhan website.</li></ol>',
            ],
            [
                'category' => HelpCategory::Kontak,
                'sort_order' => 1,
                'title' => 'Membaca pesan dari formulir kontak',
                'body' => '<p>Pesan dari halaman Kontak website masuk ke <strong>Komunikasi → Pesan Kontak</strong>. Filter berdasarkan status, buka detail untuk membaca isi lengkap, lalu tandai sudah dibaca atau hapus jika perlu.</p>',
            ],
            [
                'category' => HelpCategory::Pengguna,
                'sort_order' => 1,
                'title' => 'Menambah akun editor atau admin',
                'body' => '<p>Hanya Administrator yang dapat mengelola pengguna. Buka <strong>Sistem → Pengguna</strong> → <strong>Tambah Pengguna</strong>, isi nama, email, kata sandi, dan pilih peran.</p>',
            ],
        ];

        foreach ($articles as $article) {
            HelpArticle::query()->updateOrCreate(
                [
                    'title' => $article['title'],
                    'category' => $article['category'],
                ],
                [
                    'body' => $article['body'],
                    'sort_order' => $article['sort_order'],
                    'is_published' => true,
                ]
            );
        }

        // Hapus judul lama yang diganti supaya tidak dobel.
        HelpArticle::query()
            ->whereIn('title', [
                'Cara login dan logout',
                'Mengubah informasi situs',
                'Menambah halaman konten statis',
            ])
            ->delete();
    }
}
