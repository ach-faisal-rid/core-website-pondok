<?php

namespace App\Models;

use App\Enums\MediaType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    protected $fillable = [
        'album_id',
        'type',
        'path',
        'caption',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'type' => MediaType::class,
        ];
    }

    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class);
    }

    public function url(): string
    {
        return Storage::disk('public')->url($this->path);
    }
}
