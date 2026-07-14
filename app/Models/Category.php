<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = ['name', 'slug'];

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    public function badgeClass(): string
    {
        return match (mb_strtolower($this->name)) {
            'akademik' => 'bg-pondok-800 text-white',
            'kegiatan' => 'bg-sky-700 text-white',
            'prestasi' => 'bg-amber-700 text-white',
            'opini' => 'bg-lime-700 text-white',
            default => 'bg-stone-700 text-white',
        };
    }
}
