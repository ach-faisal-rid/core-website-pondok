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
#[Title('Panca Jiwa')]
class PancaJiwa extends Component
{
    use AuthorizesWebsiteAdmin;
    use WithToast;

    /** @var list<string> */
    public array $iconOptions = ['heart', 'leaf', 'hand', 'users', 'wind', 'book', 'building', 'calendar', 'star'];

    public string $panca_section_title = '';

    public string $home_panca_intro = '';

    /** @var list<array{title: string, description: string, icon: string}> */
    public array $panca_jiwa = [];

    public function mount(SettingService $settings): void
    {
        $this->authorizeWebsite();
        $this->panca_section_title = (string) $settings->get('panca_section_title', 'Panca Jiwa Pondok');
        $this->home_panca_intro = (string) $settings->get('home_panca_intro', '');
        $panca = $settings->json('profil_panca_jiwa', config('pondok.profil.panca_jiwa', []));
        $this->panca_jiwa = collect($panca)->map(fn ($i) => [
            'title' => (string) ($i['title'] ?? ''),
            'description' => (string) ($i['description'] ?? ''),
            'icon' => (string) ($i['icon'] ?? 'heart'),
        ])->values()->all() ?: [['title' => '', 'description' => '', 'icon' => 'heart']];
    }

    public function addItem(): void
    {
        $this->panca_jiwa[] = ['title' => '', 'description' => '', 'icon' => 'heart'];
    }

    public function removeItem(int $index): void
    {
        unset($this->panca_jiwa[$index]);
        $this->panca_jiwa = array_values($this->panca_jiwa) ?: [['title' => '', 'description' => '', 'icon' => 'heart']];
    }

    public function save(SettingService $settings): void
    {
        $this->authorize('update', \App\Models\Setting::class);
        $this->validate([
            'panca_section_title' => ['nullable', 'string', 'max:100'],
            'home_panca_intro' => ['nullable', 'string', 'max:500'],
            'panca_jiwa' => ['array'],
            'panca_jiwa.*.title' => ['nullable', 'string', 'max:100'],
            'panca_jiwa.*.description' => ['nullable', 'string', 'max:500'],
            'panca_jiwa.*.icon' => ['nullable', Rule::in($this->iconOptions)],
        ]);

        $items = collect($this->panca_jiwa)
            ->map(fn ($i) => [
                'title' => trim((string) ($i['title'] ?? '')),
                'description' => trim((string) ($i['description'] ?? '')),
                'icon' => (string) ($i['icon'] ?? 'heart'),
            ])
            ->filter(fn ($i) => $i['title'] !== '' || $i['description'] !== '')
            ->values()
            ->all();

        $settings->setMany([
            'panca_section_title' => $this->panca_section_title,
            'home_panca_intro' => $this->home_panca_intro,
            'profil_panca_jiwa' => $items,
        ], 'profil');

        $this->toastSuccess('Panca Jiwa berhasil disimpan.');
    }

    public function render()
    {
        return view('livewire.admin.website.panca-jiwa');
    }
}
