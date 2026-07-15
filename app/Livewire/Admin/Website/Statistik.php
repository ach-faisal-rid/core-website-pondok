<?php

namespace App\Livewire\Admin\Website;

use App\Livewire\Admin\Website\Concerns\AuthorizesWebsiteAdmin;
use App\Services\SettingService;
use App\Support\WithToast;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.admin')]
#[Title('Statistik')]
class Statistik extends Component
{
    use AuthorizesWebsiteAdmin;
    use WithToast;

    /** @var list<string> */
    public array $iconOptions = ['heart', 'leaf', 'hand', 'users', 'wind', 'book', 'building', 'calendar', 'star'];

    /** @var list<array{value: string, label: string, icon: string}> */
    public array $stats = [];

    public function mount(SettingService $settings): void
    {
        $this->authorizeWebsite();
        $stats = $settings->json('home_stats', config('pondok.home.stats', []));
        $this->stats = collect($stats)->map(fn ($i) => [
            'value' => (string) ($i['value'] ?? ''),
            'label' => (string) ($i['label'] ?? ''),
            'icon' => (string) ($i['icon'] ?? 'users'),
        ])->values()->all() ?: [
            ['value' => '', 'label' => '', 'icon' => 'users'],
        ];
    }

    public function addItem(): void
    {
        $this->stats[] = ['value' => '', 'label' => '', 'icon' => 'users'];
    }

    public function removeItem(int $index): void
    {
        unset($this->stats[$index]);
        $this->stats = array_values($this->stats) ?: [['value' => '', 'label' => '', 'icon' => 'users']];
    }

    public function save(SettingService $settings): void
    {
        $this->authorize('update', \App\Models\Setting::class);
        $this->validate([
            'stats' => ['array'],
            'stats.*.value' => ['nullable', 'string', 'max:50'],
            'stats.*.label' => ['nullable', 'string', 'max:100'],
            'stats.*.icon' => ['nullable', Rule::in($this->iconOptions)],
        ]);

        $items = collect($this->stats)
            ->map(fn ($i) => [
                'value' => trim((string) ($i['value'] ?? '')),
                'label' => trim((string) ($i['label'] ?? '')),
                'icon' => (string) ($i['icon'] ?? 'users'),
            ])
            ->filter(fn ($i) => $i['value'] !== '' || $i['label'] !== '')
            ->values()
            ->all();

        $settings->set('home_stats', $items, 'home');
        $this->toastSuccess('Statistik berhasil disimpan.');
    }

    public function render()
    {
        return view('livewire.admin.website.statistik');
    }
}
