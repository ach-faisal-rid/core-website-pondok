<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Download extends Model
{
    protected $fillable = [
        'title',
        'description',
        'slug',
        'file_path',
        'category',
        'file_size',
        'download_count',
    ];

    public function url(): string
    {
        return Storage::disk('public')->url($this->file_path);
    }

    public function incrementDownloadCount(): void
    {
        $this->increment('download_count');
    }

    public function extension(): string
    {
        return Str::upper(pathinfo($this->file_path, PATHINFO_EXTENSION) ?: 'FILE');
    }

    public function humanSize(): string
    {
        $bytes = (int) $this->file_size;

        if ($bytes <= 0) {
            return '—';
        }

        $units = ['B', 'KB', 'MB', 'GB'];
        $power = (int) floor(log($bytes, 1024));
        $power = min($power, count($units) - 1);

        return number_format($bytes / (1024 ** $power), $power === 0 ? 0 : 1).' '.$units[$power];
    }

    public function accent(): string
    {
        $category = Str::lower((string) $this->category);

        return match (true) {
            str_contains($category, 'kurikulum') || str_contains($category, 'akademik') => 'blue',
            str_contains($category, 'laporan') || str_contains($category, 'publikasi') => 'amber',
            default => 'green',
        };
    }
}
