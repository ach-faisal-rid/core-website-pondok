<?php

namespace App\Enums;

enum ArticleType: string
{
    case Berita = 'berita';
    case Informasi = 'informasi';
    case Pengumuman = 'pengumuman';

    public function label(): string
    {
        return match ($this) {
            self::Berita => 'Berita',
            self::Informasi => 'Informasi',
            self::Pengumuman => 'Pengumuman',
        };
    }
}
