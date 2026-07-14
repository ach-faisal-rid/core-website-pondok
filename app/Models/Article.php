<?php

namespace App\Models;

use App\Enums\ArticleType;
use App\Enums\PublishStatus;
use Database\Factories\ArticleFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Article extends Model
{
    /** @use HasFactory<ArticleFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'body',
        'type',
        'category_id',
        'author_id',
        'status',
        'published_at',
        'thumbnail',
        'seo_title',
        'seo_description',
    ];

    protected function casts(): array
    {
        return [
            'status' => PublishStatus::class,
            'type' => ArticleType::class,
            'published_at' => 'datetime',
        ];
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query
            ->where('status', PublishStatus::Published)
            ->where(function (Builder $q) {
                $q->whereNull('published_at')
                    ->orWhere('published_at', '<=', now());
            });
    }

    public function excerpt(int $limit = 140): string
    {
        return \Illuminate\Support\Str::limit(strip_tags($this->body ?? ''), $limit);
    }

    public function categoryLabel(): string
    {
        return optional($this->category)->name
            ?? $this->type->label();
    }

    public function categoryBadgeClass(): string
    {
        return $this->category?->badgeClass() ?? 'bg-pondok-800 text-white';
    }

    public function thumbnailUrl(): ?string
    {
        return $this->thumbnail ? asset('storage/'.$this->thumbnail) : null;
    }
}
