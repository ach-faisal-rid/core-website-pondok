<?php

namespace Tests\Feature;

use App\Livewire\Admin\Help\Manage;
use App\Models\HelpArticle;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class HelpCenterTest extends TestCase
{
    use RefreshDatabase;

    public function test_editor_can_access_help_index(): void
    {
        $editor = User::factory()->editor()->create();

        $this->actingAs($editor)
            ->get(route('admin.help.index'))
            ->assertOk();
    }

    public function test_editor_cannot_access_help_manage(): void
    {
        $editor = User::factory()->editor()->create();

        $this->actingAs($editor)
            ->get(route('admin.help.manage'))
            ->assertForbidden();
    }

    public function test_admin_can_access_help_manage(): void
    {
        $admin = User::factory()->admin()->create();

        $this->actingAs($admin)
            ->get(route('admin.help.manage'))
            ->assertOk();
    }

    public function test_editor_only_sees_published_help_articles(): void
    {
        $editor = User::factory()->editor()->create();

        HelpArticle::query()->create([
            'title' => 'Published item',
            'body' => '<p>Visible</p>',
            'category' => 'umum',
            'sort_order' => 1,
            'is_published' => true,
        ]);

        HelpArticle::query()->create([
            'title' => 'Draft item',
            'body' => '<p>Hidden</p>',
            'category' => 'umum',
            'sort_order' => 2,
            'is_published' => false,
        ]);

        $this->actingAs($editor)
            ->get(route('admin.help.index'))
            ->assertOk()
            ->assertSee('Published item')
            ->assertDontSee('Draft item');
    }

    public function test_admin_can_delete_help_article_via_manage(): void
    {
        $admin = User::factory()->admin()->create();
        $article = HelpArticle::query()->create([
            'title' => 'To delete',
            'body' => '<p>Body</p>',
            'category' => 'artikel',
            'sort_order' => 1,
            'is_published' => true,
        ]);

        Livewire::actingAs($admin)
            ->test(Manage::class)
            ->call('delete', $article->id)
            ->assertHasNoErrors();

        $this->assertDatabaseMissing('help_articles', ['id' => $article->id]);
    }
}
