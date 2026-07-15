<?php

namespace App\Livewire\Admin\Website;

use App\Actions\UploadMediaAction;
use App\Livewire\Admin\Website\Concerns\AuthorizesWebsiteAdmin;
use App\Services\SettingService;
use App\Support\WithToast;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.admin')]
#[Title('Hero')]
class Hero extends Component
{
    use AuthorizesWebsiteAdmin;
    use WithFileUploads;
    use WithToast;

    public string $home_hero_title = '';

    public string $home_hero_subtitle = '';

    public string $home_cta1_label = '';

    public string $home_cta1_url = '';

    public string $home_cta2_label = '';

    public string $home_cta2_url = '';

    public $home_hero;

    public ?string $home_hero_path = null;

    public function mount(SettingService $settings): void
    {
        $this->authorizeWebsite();
        $this->home_hero_title = (string) ($settings->get('home_hero_title') ?: config('pondok.home.hero_title'));
        $this->home_hero_subtitle = (string) ($settings->get('home_hero_subtitle') ?: config('pondok.home.hero_subtitle'));
        $this->home_cta1_label = (string) $settings->get('home_cta1_label', 'Jelajahi Profil');
        $this->home_cta1_url = (string) $settings->get('home_cta1_url', '/profil');
        $this->home_cta2_label = (string) $settings->get('home_cta2_label', 'Hubungi Kami');
        $this->home_cta2_url = (string) $settings->get('home_cta2_url', '/kontak');
        $this->home_hero_path = $settings->get('home_hero');
    }

    public function save(SettingService $settings, UploadMediaAction $upload): void
    {
        $this->authorize('update', \App\Models\Setting::class);
        $this->validate([
            'home_hero_title' => ['nullable', 'string', 'max:500'],
            'home_hero_subtitle' => ['nullable', 'string', 'max:1000'],
            'home_cta1_label' => ['nullable', 'string', 'max:100'],
            'home_cta1_url' => ['nullable', 'string', 'max:255'],
            'home_cta2_label' => ['nullable', 'string', 'max:100'],
            'home_cta2_url' => ['nullable', 'string', 'max:255'],
            'home_hero' => ['nullable', 'image', 'max:4096'],
        ]);

        $this->home_hero_path = $this->storeUpload($upload, $this->home_hero, $this->home_hero_path, 'settings/home');
        $this->home_hero = null;

        $settings->setMany([
            'home_hero_title' => $this->home_hero_title,
            'home_hero_subtitle' => $this->home_hero_subtitle,
            'home_cta1_label' => $this->home_cta1_label,
            'home_cta1_url' => $this->home_cta1_url,
            'home_cta2_label' => $this->home_cta2_label,
            'home_cta2_url' => $this->home_cta2_url,
            'home_hero' => $this->home_hero_path,
        ], 'home');

        $this->toastSuccess('Hero berhasil disimpan.');
    }

    public function render()
    {
        return view('livewire.admin.website.hero', [
            'preview' => $this->home_hero_path ? Storage::disk('public')->url($this->home_hero_path) : null,
        ]);
    }
}
