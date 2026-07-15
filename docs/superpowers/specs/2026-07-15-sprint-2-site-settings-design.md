# Sprint 2 — Site Management (Pengaturan bertab)

**Tanggal:** 2026-07-15  
**Status:** Disetujui

## Ringkasan

Semua identitas website editable dari `/admin/settings` dengan tab **Umum | Beranda | Profil | Kontak**, tanpa ubah kode.

## Penyimpanan

Key/value di tabel `settings`; list (statistik, misi, panca jiwa) sebagai JSON. Fallback `config/pondok.php`.

## Tab

- **Umum:** nama, tagline, logo, favicon, footer, SEO
- **Beranda:** hero + CTA + stats dinamis
- **Profil:** hero subtitle/gambar, visi, misi, motto, nilai, panca jiwa, pengasuh
- **Kontak:** telepon, WA, email, alamat, maps, sosial
