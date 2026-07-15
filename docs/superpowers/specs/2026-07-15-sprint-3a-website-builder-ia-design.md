# Sprint 3A — Website Builder IA

**Referensi:** `docs/sprint-3.md` (disetujui)  
**Tanggal:** 2026-07-15

## Tujuan

Menata ulang pengalaman admin: pusat identitas situs di menu **Website**, bukan **Pengaturan** bertab.

## Sidebar

```
Website
├── Hero
├── Tentang Pondok
├── Pengasuh
├── Visi & Misi
├── Panca Jiwa
├── Struktur Organisasi
├── Statistik
├── Navigasi
├── Footer
├── SEO
└── Tema
```

`/admin/settings` → redirect ke `website.tema` (logo/identitas).

## Halaman

Kerangka Livewire per section; field yang sudah ada di Sprint 2 dipindah ke halaman yang relevan.

- **Struktur Organisasi:** entity `OrganizationMember` (nama, jabatan, foto, parent_id nullable, urutan) — UI flat di 3A
- **Navigasi:** JSON items (label, url, urutan)
- **Tema:** logo, favicon, primary/secondary color, font note (opsional)

## Hak akses

Admin only (sama Setting policy / role:admin).
