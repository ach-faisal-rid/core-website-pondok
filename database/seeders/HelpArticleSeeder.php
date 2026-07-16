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
                'category' => HelpCategory::Umum,
                'sort_order' => 4,
                'title' => 'Alur mengisi data Website (untuk operator baru)',
                'body' => '<p>Setelah database di-seed, banyak teks sudah terisi. Ikuti langkah ini:</p><ol><li>Login sebagai Admin → buka sidebar <strong>Website</strong>.</li><li>Mulai dari <strong>Hero</strong>, lalu Tentang, Pengasuh, Visi &amp; Misi, dst.</li><li>Lihat field yang sudah terisi — ganti dengan data pondok asli.</li><li>Unggah gambar yang masih kosong (background, foto, logo, favicon).</li><li>Klik <strong>Simpan</strong> di setiap halaman.</li><li>Buka <strong>Lihat Website</strong> untuk mengecek hasil di situs publik.</li></ol><p><strong>Yang harus diunggah manual:</strong> background Hero, gambar Tentang/foto pendiri, foto Pengasuh, foto Struktur, logo, dan favicon.</p>',
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
                'body' => '<p>Menu <strong>Website</strong> (hanya Admin) adalah pusat pengelolaan identitas dan tampilan website pondok. Setiap bagian punya halaman sendiri: Hero, Tentang Pondok, Pengasuh, Visi &amp; Misi, Panca Jiwa, Struktur Organisasi, Statistik, Navigasi, Footer, SEO, dan Tema &amp; Favicon.</p><p>Beranda publik menampilkan gabungan section tersebut — bukan data terpisah bernama “Homepage”.</p>',
            ],
            [
                'category' => HelpCategory::Website,
                'sort_order' => 2,
                'title' => 'Cara mengisi Hero (contoh lengkap)',
                'body' => '<p>Hero adalah bagian paling atas beranda. Buka <strong>Website → Hero</strong>.</p><table><thead><tr><th>Field</th><th>Contoh isi</th></tr></thead><tbody><tr><td>Judul</td><td>Mencetak Generasi Beradab, Berilmu, dan Berwibawa di Era Digital.</td></tr><tr><td>Subtitle</td><td>Membangun karakter santri melalui pendidikan Islam yang kokoh, adab yang luhur, dan kesiapan menghadapi tantangan zaman.</td></tr><tr><td>Background</td><td>Unggah foto gedung/kegiatan (JPG/PNG lebar, opsional)</td></tr><tr><td>Tombol 1 — teks</td><td>Jelajahi Profil</td></tr><tr><td>Tombol 1 — URL</td><td><code>/profil</code></td></tr><tr><td>Tombol 2 — teks</td><td>Hubungi Kami</td></tr><tr><td>Tombol 2 — URL</td><td><code>/kontak</code></td></tr></tbody></table><p><strong>Tips:</strong> pakai path lokal seperti <code>/profil</code>, bukan URL panjang, kecuali ke situs luar. Simpan lalu cek di beranda.</p>',
            ],
            [
                'category' => HelpCategory::Website,
                'sort_order' => 3,
                'title' => 'Cara mengisi Tentang Pondok (contoh)',
                'body' => '<p>Buka <strong>Website → Tentang Pondok</strong>.</p><table><thead><tr><th>Field</th><th>Contoh isi</th></tr></thead><tbody><tr><td>Judul section</td><td>Tentang Pondok</td></tr><tr><td>Subtitle hero profil</td><td>Menelusuri jejak para ulama dan generasi yang kokoh dalam iman, ilmu, dan akhlak.</td></tr><tr><td>Ringkasan tentang</td><td>Paragraf singkat tentang sejarah/identitas pondok (boleh HTML <code>&lt;p&gt;</code>)</td></tr><tr><td>Gambar hero</td><td>Unggah foto kompleks pondok</td></tr><tr><td>Foto pendiri</td><td>Unggah foto pendiri (opsional)</td></tr></tbody></table><p>Sejarah panjang sebaiknya ditulis di <strong>Publikasi → Halaman</strong> (slug <code>sejarah</code>).</p>',
            ],
            [
                'category' => HelpCategory::Website,
                'sort_order' => 4,
                'title' => 'Cara mengisi Pengasuh (contoh)',
                'body' => '<p>Buka <strong>Website → Pengasuh</strong>. Ada dua blok: Pengasuh 1 dan Pengasuh 2.</p><p><strong>Pengasuh 1 (contoh)</strong></p><ul><li>Nama: K.H. Abdullah bin Muhammad</li><li>Jabatan: Pengasuh Utama</li><li>Sambutan: Assalamu\'alaikum... Selamat datang di website resmi pondok kami...</li><li>Foto: unggah foto pengasuh</li></ul><p><strong>Pengasuh 2 (contoh)</strong></p><ul><li>Nama: Ny. Hj. Siti Aminah</li><li>Jabatan: Ketua Pondok Putri</li><li>Sambutan: Kami berkomitmen mendampingi santriwati agar tumbuh dalam ilmu, adab, dan kemandirian.</li><li>Foto: unggah foto</li></ul>',
            ],
            [
                'category' => HelpCategory::Website,
                'sort_order' => 5,
                'title' => 'Cara mengisi Visi &amp; Misi (contoh)',
                'body' => '<p>Buka <strong>Website → Visi &amp; Misi</strong>.</p><ul><li><strong>Visi:</strong> Menjadi lembaga pendidikan Islam yang unggul dalam mencetak generasi berilmu, berakhlak, dan bermanfaat bagi umat.</li><li><strong>Misi 1:</strong> Menyelenggarakan pendidikan diniyah dan formal yang terpadu.</li><li><strong>Misi 2:</strong> Menanamkan akhlak mulia melalui keteladanan dan pembiasaan.</li><li><strong>Misi 3:</strong> Membangun kemandirian, ukhuwah, dan kepedulian sosial santri.</li><li><strong>Motto:</strong> Berilmu, beradab, dan bermanfaat.</li><li><strong>Nilai:</strong> Nilai pondok dijaga melalui adab, keikhlasan, dan keteladanan dalam belajar serta berkhidmat.</li></ul><p>Poin misi bisa ditambah/dihapus dengan tombol di form.</p>',
            ],
            [
                'category' => HelpCategory::Website,
                'sort_order' => 6,
                'title' => 'Cara mengisi Panca Jiwa (contoh)',
                'body' => '<p>Buka <strong>Website → Panca Jiwa</strong>.</p><ul><li><strong>Judul section:</strong> Panca Jiwa Pondok</li><li><strong>Intro:</strong> Lima nilai yang menjadi napas kehidupan santri dalam belajar, berkarya, dan berkhidmat.</li></ul><p>Contoh butir:</p><table><thead><tr><th>Judul</th><th>Deskripsi</th><th>Ikon</th></tr></thead><tbody><tr><td>Keikhlasan</td><td>Berbuat karena Allah semata...</td><td>heart</td></tr><tr><td>Kesederhanaan</td><td>Hidup hemat, bersahaja...</td><td>leaf</td></tr><tr><td>Berdikari</td><td>Mandiri dalam belajar...</td><td>hand</td></tr><tr><td>Ukhuwah</td><td>Menguatkan persaudaraan Islam...</td><td>users</td></tr><tr><td>Kebebasan</td><td>Merdeka berpikir positif...</td><td>wind</td></tr></tbody></table>',
            ],
            [
                'category' => HelpCategory::Website,
                'sort_order' => 7,
                'title' => 'Cara mengisi Struktur Organisasi (contoh)',
                'body' => '<p>Buka <strong>Website → Struktur Organisasi</strong>. Tambah anggota satu per satu (bukan lewat menu Halaman).</p><table><thead><tr><th>Urutan</th><th>Nama</th><th>Jabatan</th></tr></thead><tbody><tr><td>1</td><td>K.H. Abdullah bin Muhammad</td><td>Pengasuh Utama</td></tr><tr><td>2</td><td>Ny. Hj. Siti Aminah</td><td>Ketua Pondok Putri</td></tr><tr><td>3</td><td>Ustadz Ahmad Fauzi</td><td>Kepala Madrasah</td></tr><tr><td>4</td><td>Ustadzah Fatimah Zahra</td><td>Kepala Bagian Kesantrian</td></tr><tr><td>5</td><td>Ustadz Rizki Maulana</td><td>Sekretaris Pondok</td></tr></tbody></table><p>Foto per orang bersifat opsional. Setelah seed, beberapa anggota demo biasanya sudah ada.</p>',
            ],
            [
                'category' => HelpCategory::Website,
                'sort_order' => 8,
                'title' => 'Cara mengisi Statistik beranda (contoh)',
                'body' => '<p>Buka <strong>Website → Statistik</strong>. Setiap baris = satu angka di beranda.</p><table><thead><tr><th>Nilai</th><th>Label</th><th>Ikon</th></tr></thead><tbody><tr><td>1000+</td><td>Santri Aktif</td><td>users</td></tr><tr><td>40+ Tahun</td><td>Pengabdian Pendidikan</td><td>calendar</td></tr><tr><td>10+ Cabang</td><td>Di Seluruh Indonesia</td><td>building</td></tr></tbody></table><p>Tambah/hapus baris sesuai kebutuhan pondok, lalu Simpan.</p>',
            ],
            [
                'category' => HelpCategory::Website,
                'sort_order' => 9,
                'title' => 'Cara mengisi Navigasi (contoh)',
                'body' => '<p>Buka <strong>Website → Navigasi</strong>. Setiap item = satu menu di header/footer publik.</p><table><thead><tr><th>Label</th><th>URL</th></tr></thead><tbody><tr><td>Beranda</td><td><code>/</code></td></tr><tr><td>Profil</td><td><code>/profil</code></td></tr><tr><td>Berita</td><td><code>/artikel</code></td></tr><tr><td>Galeri</td><td><code>/galeri</code></td></tr><tr><td>Unduhan</td><td><code>/download</code></td></tr><tr><td>Kontak</td><td><code>/kontak</code></td></tr></tbody></table><p>Urutan di daftar = urutan di website. Simpan setelah mengubah.</p>',
            ],
            [
                'category' => HelpCategory::Website,
                'sort_order' => 10,
                'title' => 'Cara mengisi Footer, SEO, dan Tema (contoh)',
                'body' => '<p><strong>Footer</strong> — tagline, teks copyright, telepon, email, Facebook/Instagram/YouTube (pakai URL lengkap <code>https://...</code>).</p><p>Contoh: Tagline <em>Membangun generasi berilmu...</em>, Telepon <code>+62 341 1234567</code>, Email <code>info@pondok-digital.sch.id</code>.</p><p><strong>SEO</strong> — Judul SEO: Pondok Pesantren Digital. Deskripsi: Website resmi profil pondok pesantren — berita, galeri, unduhan, dan informasi kontak.</p><p><strong>Tema &amp; Favicon</strong> — Nama situs, logo (PNG), favicon (PNG/ICO 32×32 atau 64×64), warna primer <code>#134535</code>, warna sekunder <code>#1f6b4f</code>.</p>',
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
                'Mengubah Hero dan Statistik beranda',
                'Mengelola Pengasuh, Visi & Misi, dan Panca Jiwa',
                'Struktur Organisasi',
                'Navigasi, Footer, SEO, dan Tema',
            ])
            ->delete();
    }
}
