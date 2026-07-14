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
                'body' => '<p><strong>Administrator</strong> dapat mengelola semua modul termasuk pengaturan situs, pengguna, dan konten bantuan.</p><p><strong>Editor</strong> dapat mengelola konten, artikel, galeri, download, dan membaca pesan kontak — tetapi tidak dapat mengubah pengaturan situs atau mengelola pengguna.</p>',
            ],
            [
                'category' => HelpCategory::Umum,
                'sort_order' => 2,
                'title' => 'Cara login dan logout',
                'body' => '<ol><li>Buka halaman login di <code>/login</code>.</li><li>Masukkan email dan password akun Anda.</li><li>Setelah masuk, Anda diarahkan ke dashboard admin.</li><li>Untuk keluar, klik tombol <strong>Logout</strong> di pojok kanan atas panel.</li></ol>',
            ],
            [
                'category' => HelpCategory::Dashboard,
                'sort_order' => 1,
                'title' => 'Membaca ringkasan dashboard',
                'body' => '<p>Dashboard menampilkan jumlah konten, artikel, album galeri, file download, dan pesan kontak yang belum dibaca. Gunakan angka ini untuk memantau aktivitas situs secara cepat.</p>',
            ],
            [
                'category' => HelpCategory::Pengaturan,
                'sort_order' => 1,
                'title' => 'Mengubah informasi situs',
                'body' => '<p>Menu <strong>Pengaturan</strong> hanya dapat diakses oleh Administrator. Di sini Anda dapat mengubah nama situs, logo, kontak, media sosial, dan pengaturan SEO.</p><p>Setelah menyimpan, perubahan langsung tampil di website publik.</p>',
            ],
            [
                'category' => HelpCategory::Konten,
                'sort_order' => 1,
                'title' => 'Menambah halaman konten statis',
                'body' => '<ol><li>Buka menu <strong>Konten</strong> → <strong>Tambah Konten</strong>.</li><li>Isi judul, isi body, dan status publikasi.</li><li>Simpan — halaman dapat ditautkan dari profil atau menu lain sesuai slug.</li></ol>',
            ],
            [
                'category' => HelpCategory::Artikel,
                'sort_order' => 1,
                'title' => 'Menerbitkan artikel berita',
                'body' => '<ol><li>Buka <strong>Artikel</strong> → <strong>Tambah Artikel</strong>.</li><li>Isi judul, kategori, isi, dan thumbnail (opsional).</li><li>Pilih status <strong>Published</strong> dan tanggal publikasi.</li><li>Simpan — artikel muncul di halaman Berita website.</li></ol>',
            ],
            [
                'category' => HelpCategory::Galeri,
                'sort_order' => 1,
                'title' => 'Membuat album galeri',
                'body' => '<ol><li>Buka <strong>Galeri</strong> → buat album baru.</li><li>Isi judul, kategori, dan deskripsi.</li><li>Unggah foto atau video ke album tersebut.</li><li>Album akan tampil di halaman Galeri publik.</li></ol>',
            ],
            [
                'category' => HelpCategory::Download,
                'sort_order' => 1,
                'title' => 'Menambah file unduhan',
                'body' => '<ol><li>Buka <strong>Download</strong> → <strong>Tambah Download</strong>.</li><li>Isi judul, kategori, deskripsi, dan unggah file.</li><li>Simpan — pengunjung dapat mengunduh dari halaman Download.</li></ol>',
            ],
            [
                'category' => HelpCategory::Kontak,
                'sort_order' => 1,
                'title' => 'Membaca pesan dari formulir kontak',
                'body' => '<p>Pesan yang masuk dari halaman Kontak website tersimpan di menu <strong>Pesan Kontak</strong>. Buka detail pesan untuk membaca isi lengkap dan menandai sudah dibaca.</p>',
            ],
            [
                'category' => HelpCategory::Pengguna,
                'sort_order' => 1,
                'title' => 'Menambah akun editor atau admin',
                'body' => '<p>Hanya Administrator yang dapat mengelola pengguna. Buka <strong>Pengguna</strong> → <strong>Tambah Pengguna</strong>, isi nama, email, password, dan pilih peran.</p>',
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
    }
}
