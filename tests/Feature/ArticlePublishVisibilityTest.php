<?php

namespace Tests\Feature;

use App\Enums\PublishStatus;
use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticlePublishVisibilityTest extends TestCase
{
    use RefreshDatabase;

    public function test_draft_article_is_not_visible_on_public_show(): void
    {
        $article = Article::factory()->draft()->create([
            'author_id' => User::factory(),
            'title' => 'Artikel Draft',
            'slug' => 'artikel-draft',
        ]);

        $this->assertSame(PublishStatus::Draft, $article->status);

        $this->get(route('artikel.show', $article->slug))
            ->assertNotFound();
    }

    public function test_published_article_is_visible_on_public_show(): void
    {
        $article = Article::factory()->published()->create([
            'author_id' => User::factory(),
            'title' => 'Artikel Publik',
            'slug' => 'artikel-publik',
            'body' => '<p>Isi artikel publik.</p>',
        ]);

        $this->get(route('artikel.show', $article->slug))
            ->assertOk()
            ->assertSee('Artikel Publik')
            ->assertSee('Isi artikel publik.');
    }
}
