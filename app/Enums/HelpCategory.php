<?php

namespace App\Enums;

enum HelpCategory: string
{
    case Umum = 'umum';
    case Dashboard = 'dashboard';
    case Website = 'website';
    case Halaman = 'halaman';
    case Artikel = 'artikel';
    case Galeri = 'galeri';
    case Unduhan = 'unduhan';
    case Kontak = 'kontak';
    case Pengguna = 'pengguna';

    public function label(): string
    {
        return match ($this) {
            self::Umum => 'Umum',
            self::Dashboard => 'Dashboard',
            self::Website => 'Website',
            self::Halaman => 'Halaman',
            self::Artikel => 'Artikel',
            self::Galeri => 'Galeri',
            self::Unduhan => 'Unduhan',
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
            self::Website,
            self::Halaman,
            self::Artikel,
            self::Galeri,
            self::Unduhan,
            self::Kontak,
            self::Pengguna,
        ];
    }
}
