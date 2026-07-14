<?php

namespace Tests\Feature;

use App\Models\HelpArticle;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Tests\TestCase;

class HelpArticlePolicyTest extends TestCase
{
    use RefreshDatabase;

    public function test_editor_cannot_create_help_article(): void
    {
        $editor = User::factory()->editor()->create();

        $this->assertFalse(Gate::forUser($editor)->allows('create', HelpArticle::class));
    }

    public function test_admin_can_create_help_article(): void
    {
        $admin = User::factory()->admin()->create();

        $this->assertTrue(Gate::forUser($admin)->allows('create', HelpArticle::class));
    }

    public function test_editor_cannot_update_help_article(): void
    {
        $editor = User::factory()->editor()->create();
        $article = HelpArticle::query()->create([
            'title' => 'Test',
            'body' => '<p>Body</p>',
            'category' => 'umum',
            'sort_order' => 1,
            'is_published' => true,
        ]);

        $this->assertFalse(Gate::forUser($editor)->allows('update', $article));
    }

    public function test_editor_can_view_any_help_article(): void
    {
        $editor = User::factory()->editor()->create();

        $this->assertTrue(Gate::forUser($editor)->allows('viewAny', HelpArticle::class));
    }
}
