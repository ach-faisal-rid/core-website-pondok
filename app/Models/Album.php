<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Album extends Model
{
    public const CATEGORIES = [
        'Kegiatan Santri',
        'Fasilitas',
        'Acara Tahunan',
        'Akademik',
    ];

    protected $fillable = [
        'title',
        'slug',
        'description',
        'category',
        'thumbnail',
    ];

    public function media(): HasMany
    {
        return $this->hasMany(Media::class)->orderBy('sort_order');
    }

    public function coverUrl(): ?string
    {
        if ($this->thumbnail) {
            return Storage::disk('public')->url($this->thumbnail);
        }

        $first = $this->relationLoaded('media')
            ? $this->media->first()
            : $this->media()->first();

        return $first ? $first->url() : null;
    }
}
