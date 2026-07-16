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
#[Title('Tema & Favicon')]
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
        $this->logo_path = $this->existingMediaPath($settings->get('logo'));
        $this->favicon_path = $this->existingMediaPath($settings->get('favicon'));
    }

    protected function existingMediaPath(mixed $path): ?string
    {
        $path = is_string($path) ? trim($path) : '';

        if ($path === '' || ! Storage::disk('public')->exists($path)) {
            return null;
        }

        return $path;
    }

    protected function previewUrl(mixed $upload, ?string $storedPath): ?string
    {
        if ($upload) {
            try {
                return $upload->temporaryUrl();
            } catch (\Throwable) {
                // Local disk may not support temporaryUrl in some setups.
            }
        }

        if (filled($storedPath) && Storage::disk('public')->exists($storedPath)) {
            // Path relatif agar tidak tergantung APP_URL (localhost vs 127.0.0.1).
            return '/storage/'.ltrim($storedPath, '/');
        }

        return null;
    }

    public function removeLogo(): void
    {
        $this->authorize('update', \App\Models\Setting::class);
        if ($this->logo_path) {
            app(UploadMediaAction::class)->delete($this->logo_path);
        }
        $this->logo_path = null;
        $this->logo = null;
        app(SettingService::class)->set('logo', '', 'theme');
        $this->toastSuccess('Logo dihapus.');
    }

    public function removeFavicon(): void
    {
        $this->authorize('update', \App\Models\Setting::class);
        if ($this->favicon_path) {
            app(UploadMediaAction::class)->delete($this->favicon_path);
        }
        $this->favicon_path = null;
        $this->favicon = null;
        app(SettingService::class)->set('favicon', '', 'theme');
        $this->toastSuccess('Favicon dihapus.');
    }

    public function save(SettingService $settings, UploadMediaAction $upload): void
    {
        $this->authorize('update', \App\Models\Setting::class);
        $this->validate([
            'site_name' => ['required', 'string', 'max:255'],
            'theme_primary' => ['nullable', 'string', 'max:20'],
            'theme_secondary' => ['nullable', 'string', 'max:20'],
            'logo' => ['nullable', 'image', 'max:2048'],
            'favicon' => ['nullable', 'file', 'mimes:jpg,jpeg,png,gif,webp,ico', 'max:1024'],
        ]);

        if ($this->logo) {
            $this->logo_path = $this->storeUpload($upload, $this->logo, $this->logo_path, 'settings');
            $this->logo = null;
        }

        if ($this->favicon) {
            $this->favicon_path = $this->storeUpload($upload, $this->favicon, $this->favicon_path, 'settings');
            $this->favicon = null;
        }

        // Jangan timpa path media dengan null saat hanya mengubah teks/warna.
        $payload = [
            'site_name' => $this->site_name,
            'theme_primary' => $this->theme_primary,
            'theme_secondary' => $this->theme_secondary,
        ];

        if ($this->logo_path !== null) {
            $payload['logo'] = $this->logo_path;
        }

        if ($this->favicon_path !== null) {
            $payload['favicon'] = $this->favicon_path;
        }

        $settings->setMany($payload, 'theme');

        $this->toastSuccess('Tema berhasil disimpan.');
    }

    public function render()
    {
        return view('livewire.admin.website.tema', [
            'logoUrl' => $this->previewUrl($this->logo, $this->logo_path),
            'faviconUrl' => $this->previewUrl($this->favicon, $this->favicon_path),
        ]);
    }
}
