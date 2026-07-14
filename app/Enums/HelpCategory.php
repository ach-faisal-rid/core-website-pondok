<?php

namespace App\Enums;

enum HelpCategory: string
{
    case Umum = 'umum';
    case Dashboard = 'dashboard';
    case Pengaturan = 'pengaturan';
    case Konten = 'konten';
    case Artikel = 'artikel';
    case Galeri = 'galeri';
    case Download = 'download';
    case Kontak = 'kontak';
    case Pengguna = 'pengguna';

    public function label(): string
    {
        return match ($this) {
            self::Umum => 'Umum',
            self::Dashboard => 'Dashboard',
            self::Pengaturan => 'Pengaturan',
            self::Konten => 'Konten',
            self::Artikel => 'Artikel',
            self::Galeri => 'Galeri',
            self::Download => 'Download',
            self::Kontak => 'Pesan Kontak',
            self::Pengguna => 'Pengguna',
        };
    }

    /** @return list<self> */
    public static function ordered(): array
    {
        return [
            self::Umum,
            self::Dashboard,
            self::Pengaturan,
            self::Konten,
            self::Artikel,
            self::Galeri,
            self::Download,
            self::Kontak,
            self::Pengguna,
        ];
    }
}
