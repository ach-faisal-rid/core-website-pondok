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
#[Title('Tentang Pondok')]
class Tentang extends Component
{
    use AuthorizesWebsiteAdmin;
    use WithFileUploads;
    use WithToast;

    public string $profil_hero_subtitle = '';

    public string $tentang_title = '';

    public string $tentang_body = '';

    public $profil_hero;

    public ?string $profil_hero_path = null;

    public $profil_founder_photo;

    public ?string $profil_founder_photo_path = null;

    public function mount(SettingService $settings): void
    {
        $this->authorizeWebsite();
        $this->profil_hero_subtitle = (string) ($settings->get('profil_hero_subtitle') ?: config('pondok.profil.hero_subtitle'));
        $this->tentang_title = (string) $settings->get('tentang_title', 'Tentang Pondok');
        $this->tentang_body = (string) $settings->get('tentang_body', '');
        $this->profil_hero_path = $settings->get('profil_hero');
        $this->profil_founder_photo_path = $settings->get('profil_founder_photo');
    }

    public function save(SettingService $settings, UploadMediaAction $upload): void
    {
        $this->authorize('update', \App\Models\Setting::class);
        $this->validate([
            'profil_hero_subtitle' => ['nullable', 'string', 'max:500'],
            'tentang_title' => ['nullable', 'string', 'max:255'],
            'tentang_body' => ['nullable', 'string'],
            'profil_hero' => ['nullable', 'image', 'max:4096'],
            'profil_founder_photo' => ['nullable', 'image', 'max:4096'],
        ]);

        $this->profil_hero_path = $this->storeUpload($upload, $this->profil_hero, $this->profil_hero_path, 'settings/profil');
        $this->profil_hero = null;
        $this->profil_founder_photo_path = $this->storeUpload($upload, $this->profil_founder_photo, $this->profil_founder_photo_path, 'settings/profil');
        $this->profil_founder_photo = null;

        $settings->setMany([
            'profil_hero_subtitle' => $this->profil_hero_subtitle,
            'tentang_title' => $this->tentang_title,
            'tentang_body' => $this->tentang_body,
            'profil_hero' => $this->profil_hero_path,
            'profil_founder_photo' => $this->profil_founder_photo_path,
        ], 'profil');

        $this->toastSuccess('Tentang Pondok berhasil disimpan.');
    }

    public function render()
    {
        return view('livewire.admin.website.tentang', [
            'heroUrl' => $this->profil_hero_path ? Storage::disk('public')->url($this->profil_hero_path) : null,
            'founderUrl' => $this->profil_founder_photo_path ? Storage::disk('public')->url($this->profil_founder_photo_path) : null,
        ]);
    }
}
