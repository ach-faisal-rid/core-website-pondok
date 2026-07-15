<?php

namespace App\Livewire\Admin\Website;

use App\Livewire\Admin\Website\Concerns\AuthorizesWebsiteAdmin;
use App\Services\SettingService;
use App\Support\WithToast;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.admin')]
#[Title('SEO')]
class Seo extends Component
{
    use AuthorizesWebsiteAdmin;
    use WithToast;

    public string $seo_title = '';

    public string $seo_description = '';

    public function mount(SettingService $settings): void
    {
        $this->authorizeWebsite();
        $this->seo_title = (string) $settings->get('seo_title', '');
        $this->seo_description = (string) $settings->get('seo_description', '');
    }

    public function save(SettingService $settings): void
    {
        $this->authorize('update', \App\Models\Setting::class);
        $this->validate([
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:500'],
        ]);

        $settings->setMany([
            'seo_title' => $this->seo_title,
            'seo_description' => $this->seo_description,
        ], 'seo');

        $this->toastSuccess('SEO berhasil disimpan.');
    }

    public function render()
    {
        return view('livewire.admin.website.seo');
    }
}
