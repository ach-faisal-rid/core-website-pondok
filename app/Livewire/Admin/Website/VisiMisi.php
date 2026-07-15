<?php

namespace App\Livewire\Admin\Website;

use App\Livewire\Admin\Website\Concerns\AuthorizesWebsiteAdmin;
use App\Services\SettingService;
use App\Support\WithToast;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.admin')]
#[Title('Visi & Misi')]
class VisiMisi extends Component
{
    use AuthorizesWebsiteAdmin;
    use WithToast;

    public string $profil_visi = '';

    /** @var list<string> */
    public array $misi = [];

    public string $profil_motto = '';

    public string $profil_nilai = '';

    public function mount(SettingService $settings): void
    {
        $this->authorizeWebsite();
        $this->profil_visi = (string) ($settings->get('profil_visi') ?: config('pondok.profil.visi'));
        $this->profil_motto = (string) $settings->get('profil_motto', '');
        $this->profil_nilai = (string) $settings->get('profil_nilai', '');
        $misi = $settings->json('profil_misi', config('pondok.profil.misi', []));
        $this->misi = array_values(array_map('strval', $misi)) ?: [''];
    }

    public function addMisi(): void
    {
        $this->misi[] = '';
    }

    public function removeMisi(int $index): void
    {
        unset($this->misi[$index]);
        $this->misi = array_values($this->misi) ?: [''];
    }

    public function save(SettingService $settings): void
    {
        $this->authorize('update', \App\Models\Setting::class);
        $this->validate([
            'profil_visi' => ['nullable', 'string', 'max:2000'],
            'misi' => ['array'],
            'misi.*' => ['nullable', 'string', 'max:500'],
            'profil_motto' => ['nullable', 'string', 'max:500'],
            'profil_nilai' => ['nullable', 'string', 'max:2000'],
        ]);

        $misi = collect($this->misi)->map(fn ($i) => trim((string) $i))->filter()->values()->all();

        $settings->setMany([
            'profil_visi' => $this->profil_visi,
            'profil_misi' => $misi,
            'profil_motto' => $this->profil_motto,
            'profil_nilai' => $this->profil_nilai,
        ], 'profil');

        $this->toastSuccess('Visi & misi berhasil disimpan.');
    }

    public function render()
    {
        return view('livewire.admin.website.visi-misi');
    }
}
