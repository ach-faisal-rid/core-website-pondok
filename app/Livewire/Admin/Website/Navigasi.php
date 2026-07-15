<?php

namespace App\Livewire\Admin\Website;

use App\Livewire\Admin\Website\Concerns\AuthorizesWebsiteAdmin;
use App\Services\SettingService;
use App\Support\WithToast;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.admin')]
#[Title('Navigasi')]
class Navigasi extends Component
{
    use AuthorizesWebsiteAdmin;
    use WithToast;

    /** @var list<array{label: string, url: string}> */
    public array $items = [];

    public function mount(SettingService $settings): void
    {
        $this->authorizeWebsite();
        $nav = $settings->json('website_nav', [
            ['label' => 'Beranda', 'url' => '/'],
            ['label' => 'Profil', 'url' => '/profil'],
            ['label' => 'Artikel', 'url' => '/artikel'],
            ['label' => 'Galeri', 'url' => '/galeri'],
            ['label' => 'Download', 'url' => '/download'],
            ['label' => 'Kontak', 'url' => '/kontak'],
        ]);
        $this->items = collect($nav)->map(fn ($i) => [
            'label' => (string) ($i['label'] ?? ''),
            'url' => (string) ($i['url'] ?? ''),
        ])->values()->all() ?: [['label' => '', 'url' => '']];
    }

    public function addItem(): void
    {
        $this->items[] = ['label' => '', 'url' => ''];
    }

    public function removeItem(int $index): void
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items) ?: [['label' => '', 'url' => '']];
    }

    public function save(SettingService $settings): void
    {
        $this->authorize('update', \App\Models\Setting::class);
        $this->validate([
            'items' => ['array'],
            'items.*.label' => ['nullable', 'string', 'max:100'],
            'items.*.url' => ['nullable', 'string', 'max:255'],
        ]);

        $items = collect($this->items)
            ->map(fn ($i) => [
                'label' => trim((string) ($i['label'] ?? '')),
                'url' => trim((string) ($i['url'] ?? '')),
            ])
            ->filter(fn ($i) => $i['label'] !== '')
            ->values()
            ->all();

        $settings->set('website_nav', $items, 'website');
        $this->toastSuccess('Navigasi berhasil disimpan.');
    }

    public function render()
    {
        return view('livewire.admin.website.navigasi');
    }
}
