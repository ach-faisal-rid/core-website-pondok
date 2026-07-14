# Desain: Admin UI Shell (Scope B)

**Tanggal:** 2026-07-14  
**Status:** Disetujui  
**Referensi visual:** mockup Pesantren Digital (sidebar putih, aksen hijau hutan)

## Scope

**Masuk:**
- Redesign `layouts/admin` (sidebar, header, footer, tipografi/warna)
- Komponen admin reusable (page-header, badge dasar)
- Polish **Dashboard** & **Pesan Kontak** (filter status, stats unread, tabel)

**Belum:**
- Ekspor CSV, status “Sudah dibalas”, notifikasi realtime
- Redesign penuh semua CRUD (Konten, Artikel, Galeri, Download, User, Form)
- Fitur pendaftaran/registrasi

## Visual

| Token | Nilai |
|-------|--------|
| Primary | hijau hutan (`pondok-800` / `#14532d`–`#0f3a2d`) |
| Sidebar | putih, border `pondok-line` |
| Aktif menu | bg hijau muda + bar kiri primary |
| Font brand | Cormorant Garamond (display) |
| Font UI | Plus Jakarta Sans (sama dengan website) |

## Shell

- Grup **GENERAL**: Dashboard, Pengaturan*, Konten, Artikel, Galeri, Download, Pesan Kontak  
- Grup **SYSTEM**: Pengguna*, Bantuan  
- Bawah: Lihat Website + profil (nama, email, logout)  
- Header: breadcrumb + global search (UI stub) + bell (badge unread contacts)  
- Footer: © + tautan Bantuan  

\* sesuai policy role

## Halaman

### Dashboard
Kartu ringkasan dengan ikon + angka, link ke modul terkait.

### Pesan Kontak
- Judul “Manajemen Pesan” + deskripsi  
- Tombol Segarkan (`$refresh`)  
- Filter cari + status (Semua / Belum dibaca / Sudah dibaca)  
- Kartu Pesan baru  
- Tabel: pengirim, subjek+cuplikan, status pill, tanggal, aksi  
