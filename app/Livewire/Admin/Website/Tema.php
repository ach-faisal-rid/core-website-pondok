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
#[Title('Tema')]
class Tema extends Component
{
    use AuthorizesWebsiteAdmin;
    use WithFileUploads;
    use WithToast;

    public string $site_name = '';

    public string $theme_primary = '#134535';

    public string $theme_secondary = '#1f6b4f';

    public $logo;

    public ?string $logo_path = null;

    public $favicon;

    public ?string $favicon_path = null;

    public function mount(SettingService $settings): void
    {
        $this->authorizeWebsite();
        $this->site_name = (string) $settings->get('site_name', config('app.name'));
        $this->theme_primary = (string) $settings->get('theme_primary', '#134535');
        $this->theme_secondary = (string) $settings->get('theme_secondary', '#1f6b4f');
        $this->logo_path = $settings->get('logo');
        $this->favicon_path = $settings->get('favicon');
    }

    public function save(SettingService $settings, UploadMediaAction $upload): void
    {
        $this->authorize('update', \App\Models\Setting::class);
        $this->validate([
            'site_name' => ['required', 'string', 'max:255'],
            'theme_primary' => ['nullable', 'string', 'max:20'],
            'theme_secondary' => ['nullable', 'string', 'max:20'],
            'logo' => ['nullable', 'image', 'max:2048'],
            'favicon' => ['nullable', 'image', 'max:1024'],
        ]);

        $this->logo_path = $this->storeUpload($upload, $this->logo, $this->logo_path, 'settings');
        $this->logo = null;
        $this->favicon_path = $this->storeUpload($upload, $this->favicon, $this->favicon_path, 'settings');
        $this->favicon = null;

        $settings->setMany([
            'site_name' => $this->site_name,
            'logo' => $this->logo_path,
            'favicon' => $this->favicon_path,
            'theme_primary' => $this->theme_primary,
            'theme_secondary' => $this->theme_secondary,
        ], 'theme');

        $this->toastSuccess('Tema berhasil disimpan.');
    }

    public function render()
    {
        return view('livewire.admin.website.tema', [
            'logoUrl' => $this->logo_path ? Storage::disk('public')->url($this->logo_path) : null,
            'faviconUrl' => $this->favicon_path ? Storage::disk('public')->url($this->favicon_path) : null,
        ]);
    }
}
