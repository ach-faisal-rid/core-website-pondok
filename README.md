# CMS Website Pondok Pesantren

Sistem manajemen konten untuk website profil pondok pesantren: halaman publik (beranda, profil, artikel, galeri, unduhan, kontak) dan panel admin untuk mengelola isi situs.

Pendaftaran akun publik / PPDB sementara **dimatikan**. Akun panel dibuat melalui admin (menu Pengguna).

---

## Fitur singkat

### Website publik
- Beranda, Profil, Artikel/Berita, Galeri, Download, Kontak
- Pencarian artikel, filter kategori, sitemap

### Panel admin (`/admin`)
| Modul | Keterangan |
|--------|------------|
| Dashboard | Ringkasan data CMS |
| Pengaturan | Identitas situs, kontak, SEO, sosial (**admin saja**) |
| Konten | Halaman profil/statis |
| Artikel | Berita & tulisan |
| Galeri | Album & media |
| Download | File unduhan |
| Pesan Kontak | Pesan dari formulir website |
| Pengguna | Kelola akun (**admin saja**) |
| Bantuan | FAQ & panduan CMS (editor hanya baca; admin bisa kelola) |

---

## Peran pengguna

| Peran | Hak akses |
|--------|-----------|
| **Administrator** | Semua modul termasuk Pengaturan, Pengguna, dan kelola Bantuan |
| **Editor** | Konten, Artikel, Galeri, Download, Pesan Kontak, baca Bantuan — tanpa Pengaturan & Pengguna |

---

## Akun demo (setelah seed)

Password untuk semua akun seed: `password`

| Nama | Email | Peran |
|------|--------|--------|
| Administrator | `admin@pondok.test` | admin |
| Editor | `editor@pondok.test` | editor |

**Login panel:** buka `/login`  
**Dashboard:** `/admin`  
**Website publik:** `/`

> Ganti password setelah dipakai di lingkungan nyata. Jangan commit file `.env`.

---

## Persyaratan lingkungan

- PHP 8.3+
- Composer
- Node.js & npm
- Database: SQLite (default) atau MySQL/MariaDB

---

## Instalasi & menjalankan

```bash
# 1. Dependensi backend
composer install

# 2. Lingkungan
copy .env.example .env
php artisan key:generate

# 3. Database (SQLite)
# Pastikan file database/database.sqlite ada, atau atur DB_* di .env
php artisan migrate --seed

# 4. Storage publik (upload gambar/file)
php artisan storage:link

# 5. Aset frontend
npm install
npm run build

# 6. Jalankan server
php artisan serve
```

Aplikasi biasanya tersedia di `http://127.0.0.1:8000`.

### Mode pengembangan frontend

Jika mengubah CSS/JS, jalankan di terminal terpisah:

```bash
npm run dev
```

---

## Alur pemakaian tipikal

1. Login sebagai admin → **Pengaturan**: isi nama situs, logo, kontak, SEO.
2. Isi **Konten** profil (sejarah, visi-misi, dll.).
3. Publikasikan **Artikel**, **Galeri**, dan **Download**.
4. Pantau **Pesan Kontak** dari formulir website.
5. Tambah akun editor lewat **Pengguna** jika perlu.
6. Lihat / sunting panduan di **Bantuan**.

Editor mengikuti langkah 2–4 dan 6 (baca), tanpa mengubah pengaturan atau user.

---

## URL penting

| Halaman | URL |
|---------|-----|
| Beranda | `/` |
| Login | `/login` |
| Admin | `/admin` |
| Bantuan admin | `/admin/bantuan` |
| Sitemap | `/sitemap.xml` |

Route `/register` **tidak aktif** (registrasi publik dinonaktifkan).

---

## Perintah berguna

```bash
# Migrasi + data awal (user, pengaturan, contoh bantuan)
php artisan migrate --seed

# Seed bantuan saja
php artisan db:seed --class=HelpArticleSeeder

# Tes otomatis
php artisan test

# Build aset produksi
npm run build
```

---

## Struktur ringkas

```
app/                  Model, Livewire admin/web, policy, service
database/migrations/  Skema database
database/seeders/     Data awal & akun demo
resources/views/      Tampilan website & panel admin
routes/web.php        Route publik
routes/admin.php      Route panel admin
docs/                 Spesifikasi & rencana fitur
```

---

## Catatan keamanan

- File `.env` tidak ikut ke Git; salin dari `.env.example`.
- Akun seed hanya untuk development / demo.
- Upload file tersimpan di storage; pastikan `php artisan storage:link` sudah dijalankan.
