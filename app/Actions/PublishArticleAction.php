<?php

namespace App\Actions;

use App\Enums\PublishStatus;
use App\Models\Article;

class PublishArticleAction
{
    public function execute(Article $article, ?\DateTimeInterface $publishedAt = null): Article
    {
        $publishedAt = $publishedAt ?? now();

        $article->update([
            'status' => $publishedAt > now()
                ? PublishStatus::Scheduled
                : PublishStatus::Published,
            'published_at' => $publishedAt,
        ]);

        return $article->refresh();
    }
}
