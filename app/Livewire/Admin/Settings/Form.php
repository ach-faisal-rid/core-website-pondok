<?php

namespace App\Livewire\Admin\Settings;

use App\Actions\UploadMediaAction;
use App\Models\Setting;
use App\Services\SettingService;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Support\WithToast;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.admin')]
#[Title('Pengaturan')]
class Form extends Component
{
    use WithToast;

    use WithFileUploads;

    public string $site_name = '';

    public string $site_tagline = '';

    public $logo;

    public ?string $logo_path = null;

    public $favicon;

    public ?string $favicon_path = null;

    public string $footer_text = '';

    public string $seo_title = '';

    public string $seo_description = '';

    public string $phone = '';

    public string $whatsapp = '';

    public string $email = '';

    public string $address = '';

    public string $maps_embed = '';

    public string $facebook = '';

    public string $instagram = '';

    public string $youtube = '';

    public function mount(SettingService $settings): void
    {
        $this->authorize('viewAny', Setting::class);

        $this->site_name = (string) $settings->get('site_name', config('app.name'));
        $this->site_tagline = (string) $settings->get('site_tagline', '');
        $this->logo_path = $settings->get('logo');
        $this->favicon_path = $settings->get('favicon');
        $this->footer_text = (string) $settings->get('footer_text', '');
        $this->seo_title = (string) $settings->get('seo_title', '');
        $this->seo_description = (string) $settings->get('seo_description', '');
        $this->phone = (string) $settings->get('phone', '');
        $this->whatsapp = (string) $settings->get('whatsapp', '');
        $this->email = (string) $settings->get('email', '');
        $this->address = (string) $settings->get('address', '');
        $this->maps_embed = (string) $settings->get('maps_embed', '');
        $this->facebook = (string) $settings->get('facebook', '');
        $this->instagram = (string) $settings->get('instagram', '');
        $this->youtube = (string) $settings->get('youtube', '');
    }

    public function save(SettingService $settings, UploadMediaAction $upload): void
    {
        $this->authorize('update', Setting::class);

        $this->validate([
            'site_name' => ['required', 'string', 'max:255'],
            'site_tagline' => ['nullable', 'string', 'max:255'],
            'logo' => ['nullable', 'image', 'max:2048'],
            'favicon' => ['nullable', 'image', 'max:1024'],
            'footer_text' => ['nullable', 'string', 'max:1000'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:500'],
            'phone' => ['nullable', 'string', 'max:50'],
            'whatsapp' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'address' => ['nullable', 'string', 'max:1000'],
            'maps_embed' => ['nullable', 'string'],
            'facebook' => ['nullable', 'url', 'max:255'],
            'instagram' => ['nullable', 'url', 'max:255'],
            'youtube' => ['nullable', 'url', 'max:255'],
        ]);

        if ($this->logo) {
            $upload->delete($this->logo_path);
            $this->logo_path = $upload->execute($this->logo, 'settings');
            $this->logo = null;
        }

        if ($this->favicon) {
            $upload->delete($this->favicon_path);
            $this->favicon_path = $upload->execute($this->favicon, 'settings');
            $this->favicon = null;
        }

        $settings->setMany([
            'site_name' => $this->site_name,
            'site_tagline' => $this->site_tagline,
            'logo' => $this->logo_path,
            'favicon' => $this->favicon_path,
            'footer_text' => $this->footer_text,
        ], 'general');

        $settings->setMany([
            'seo_title' => $this->seo_title,
            'seo_description' => $this->seo_description,
        ], 'seo');

        $settings->setMany([
            'phone' => $this->phone,
            'whatsapp' => $this->whatsapp,
            'email' => $this->email,
            'address' => $this->address,
            'maps_embed' => $this->maps_embed,
        ], 'contact');

        $settings->setMany([
            'facebook' => $this->facebook,
            'instagram' => $this->instagram,
            'youtube' => $this->youtube,
        ], 'social');

        $this->toastSuccess('Pengaturan berhasil disimpan.');
    }

    public function render()
    {
        return view('livewire.admin.settings.form', [
            'logoUrl' => $this->logo_path ? Storage::disk('public')->url($this->logo_path) : null,
            'faviconUrl' => $this->favicon_path ? Storage::disk('public')->url($this->favicon_path) : null,
        ]);
    }
}
