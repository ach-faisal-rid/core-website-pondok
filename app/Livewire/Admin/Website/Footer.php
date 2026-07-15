<?php

namespace App\Livewire\Admin\Website;

use App\Livewire\Admin\Website\Concerns\AuthorizesWebsiteAdmin;
use App\Services\SettingService;
use App\Support\WithToast;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.admin')]
#[Title('Footer')]
class Footer extends Component
{
    use AuthorizesWebsiteAdmin;
    use WithToast;

    public string $footer_text = '';

    public string $site_tagline = '';

    public string $phone = '';

    public string $email = '';

    public string $facebook = '';

    public string $instagram = '';

    public string $youtube = '';

    public function mount(SettingService $settings): void
    {
        $this->authorizeWebsite();
        $this->footer_text = (string) $settings->get('footer_text', '');
        $this->site_tagline = (string) $settings->get('site_tagline', '');
        $this->phone = (string) $settings->get('phone', '');
        $this->email = (string) $settings->get('email', '');
        $this->facebook = (string) $settings->get('facebook', '');
        $this->instagram = (string) $settings->get('instagram', '');
        $this->youtube = (string) $settings->get('youtube', '');
    }

    public function save(SettingService $settings): void
    {
        $this->authorize('update', \App\Models\Setting::class);
        $this->validate([
            'footer_text' => ['nullable', 'string', 'max:1000'],
            'site_tagline' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'facebook' => ['nullable', 'url', 'max:255'],
            'instagram' => ['nullable', 'url', 'max:255'],
            'youtube' => ['nullable', 'url', 'max:255'],
        ]);

        $settings->setMany([
            'footer_text' => $this->footer_text,
            'site_tagline' => $this->site_tagline,
        ], 'general');

        $settings->setMany([
            'phone' => $this->phone,
            'email' => $this->email,
        ], 'contact');

        $settings->setMany([
            'facebook' => $this->facebook,
            'instagram' => $this->instagram,
            'youtube' => $this->youtube,
        ], 'social');

        $this->toastSuccess('Footer berhasil disimpan.');
    }

    public function render()
    {
        return view('livewire.admin.website.footer');
    }
}
