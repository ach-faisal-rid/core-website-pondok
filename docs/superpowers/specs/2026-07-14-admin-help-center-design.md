# Desain: Pusat Bantuan Admin (FAQ & Panduan CMS)

**Tanggal:** 2026-07-14  
**Status:** Disetujui

## Ringkasan

Halaman bantuan di panel admin untuk **admin** dan **editor**. Berisi FAQ dan panduan pengelolaan CMS, dikelompokkan per kategori modul. Admin mengelola isi via CRUD; editor hanya membaca.

## Kebutuhan

| Aspek | Keputusan |
|-------|-----------|
| Audiens | Admin & editor di panel `/admin` |
| Konten | FAQ + panduan pengelolaan CMS |
| Struktur | Satu jenis entry, dikelompokkan per kategori modul |
| Pengelolaan | CRUD oleh admin saja; editor read-only |
| Lokasi | Hanya di panel admin (bukan website publik) |

## Kategori (`HelpCategory` enum)

- `umum` — login, peran admin vs editor
- `dashboard` — ringkasan dashboard
- `pengaturan` — pengaturan situs (admin only di CMS)
- `konten` — halaman konten statis
- `artikel` — berita/artikel
- `galeri` — album & media
- `download` — dokumen unduhan
- `kontak` — pesan kontak
- `pengguna` — manajemen user (admin only di CMS)

## Model: `HelpArticle`

| Field | Tipe | Keterangan |
|-------|------|------------|
| `title` | string | Judul topik |
| `body` | longText | Isi panduan/jawaban (HTML) |
| `category` | HelpCategory | Pengelompokan modul |
| `sort_order` | unsigned int | Urutan dalam kategori (default 0) |
| `is_published` | boolean | Tampil di halaman baca (default true) |

Tidak perlu slug — konten internal admin.

## Hak Akses (`HelpArticlePolicy`)

| Aksi | Admin | Editor |
|------|-------|--------|
| `viewAny` / `view` | ✅ | ✅ |
| `create` / `update` / `delete` | ✅ | ❌ |

Pola mengikuti `SettingPolicy` dan `UserPolicy`.

## Halaman & Route

| Route | Komponen | Akses |
|-------|----------|-------|
| `GET /admin/bantuan` | `Help\Index` | Admin + editor (hanya item published untuk editor) |
| `GET /admin/bantuan/kelola` | `Help\Manage` | Admin (`authorize create`) |
| `GET /admin/bantuan/buat` | `Help\Form` | Admin |
| `GET /admin/bantuan/{helpArticle}/edit` | `Help\Form` | Admin |

## UI

### Halaman baca (`/admin/bantuan`)
- Link sidebar **Bantuan** (semua user terautentikasi)
- Kotak pencarian judul/isi
- Accordion per kategori (Alpine)
- Tombol **Kelola Bantuan** hanya jika `@can('create', HelpArticle::class)`

### Halaman kelola (`/admin/bantuan/kelola`)
- Tabel: judul, kategori, urutan, status publish
- Filter kategori + search
- Tambah / edit / hapus

### Form
- Judul, kategori (select), urutan, status publish (checkbox), body (textarea)

## Seed

`HelpArticleSeeder` dengan contoh 1–2 item per kategori utama.

## Testing

- `HelpArticlePolicyTest` — editor tidak bisa create/update/delete; admin bisa
- `HelpCenterTest` — editor bisa akses `/admin/bantuan`, tidak bisa `/admin/bantuan/kelola`

## Di Luar Scope

- Halaman bantuan publik
- Upload gambar di body panduan
- Versi/riwayat perubahan
