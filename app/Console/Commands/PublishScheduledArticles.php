<?php

namespace App\Console\Commands;

use App\Enums\PublishStatus;
use App\Models\Article;
use Illuminate\Console\Command;

class PublishScheduledArticles extends Command
{
    protected $signature = 'articles:publish-scheduled';

    protected $description = 'Publikasikan artikel terjadwal yang sudah melewati waktu publish';

    public function handle(): int
    {
        $count = Article::query()
            ->where('status', PublishStatus::Scheduled)
            ->where('published_at', '<=', now())
            ->update(['status' => PublishStatus::Published]);

        $this->info("Dipublikasikan: {$count} artikel.");

        return self::SUCCESS;
    }
}
