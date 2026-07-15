<?php

namespace Tests\Feature;

use App\Livewire\Admin\Website\Hero;
use App\Livewire\Admin\Website\Statistik;
use App\Models\User;
use App\Services\SettingService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class SiteSettingsTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_save_hero_and_stats_and_they_appear_on_homepage(): void
    {
        $admin = User::factory()->admin()->create();

        Livewire::actingAs($admin)
            ->test(Hero::class)
            ->set('home_hero_title', 'Judul Hero Baru')
            ->set('home_hero_subtitle', 'Subtitle hero baru')
            ->call('save')
            ->assertHasNoErrors();

        Livewire::actingAs($admin)
            ->test(Statistik::class)
            ->set('stats', [
                ['value' => '500+', 'label' => 'Santri', 'icon' => 'users'],
                ['value' => '20', 'label' => 'Ustadz', 'icon' => 'book'],
            ])
            ->call('save')
            ->assertHasNoErrors();

        $settings = app(SettingService::class);
        $this->assertSame('Judul Hero Baru', $settings->get('home_hero_title'));
        $this->assertCount(2, $settings->json('home_stats'));

        $this->get(route('home'))
            ->assertOk()
            ->assertSee('Judul Hero Baru')
            ->assertSee('500+')
            ->assertSee('Santri');
    }

    public function test_editor_cannot_access_website_builder(): void
    {
        $editor = User::factory()->editor()->create();

        $this->actingAs($editor)
            ->get(route('admin.website.hero'))
            ->assertForbidden();
    }

    public function test_admin_can_open_website_sections(): void
    {
        $admin = User::factory()->admin()->create();

        $this->actingAs($admin)
            ->get(route('admin.website.hero'))
            ->assertOk();

        $this->actingAs($admin)
            ->get(route('admin.website.struktur'))
            ->assertOk();
    }
}
