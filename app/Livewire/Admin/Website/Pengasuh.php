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
#[Title('Pengasuh')]
class Pengasuh extends Component
{
    use AuthorizesWebsiteAdmin;
    use WithFileUploads;
    use WithToast;

    public string $pengasuh_1_name = '';

    public string $pengasuh_1_title = '';

    public string $pengasuh_1_sambutan = '';

    public $pengasuh_1_photo;

    public ?string $pengasuh_1_photo_path = null;

    public string $pengasuh_2_name = '';

    public string $pengasuh_2_title = '';

    public string $pengasuh_2_sambutan = '';

    public $pengasuh_2_photo;

    public ?string $pengasuh_2_photo_path = null;

    public function mount(SettingService $settings): void
    {
        $this->authorizeWebsite();
        $this->pengasuh_1_name = (string) $settings->get('pengasuh_1_name', '');
        $this->pengasuh_1_title = (string) $settings->get('pengasuh_1_title', '');
        $this->pengasuh_1_sambutan = (string) $settings->get('pengasuh_1_sambutan', '');
        $this->pengasuh_1_photo_path = $settings->get('pengasuh_1_photo');
        $this->pengasuh_2_name = (string) $settings->get('pengasuh_2_name', '');
        $this->pengasuh_2_title = (string) $settings->get('pengasuh_2_title', '');
        $this->pengasuh_2_sambutan = (string) $settings->get('pengasuh_2_sambutan', '');
        $this->pengasuh_2_photo_path = $settings->get('pengasuh_2_photo');
    }

    public function save(SettingService $settings, UploadMediaAction $upload): void
    {
        $this->authorize('update', \App\Models\Setting::class);
        $this->validate([
            'pengasuh_1_name' => ['nullable', 'string', 'max:255'],
            'pengasuh_1_title' => ['nullable', 'string', 'max:255'],
            'pengasuh_1_sambutan' => ['nullable', 'string'],
            'pengasuh_1_photo' => ['nullable', 'image', 'max:4096'],
            'pengasuh_2_name' => ['nullable', 'string', 'max:255'],
            'pengasuh_2_title' => ['nullable', 'string', 'max:255'],
            'pengasuh_2_sambutan' => ['nullable', 'string'],
            'pengasuh_2_photo' => ['nullable', 'image', 'max:4096'],
        ]);

        $this->pengasuh_1_photo_path = $this->storeUpload($upload, $this->pengasuh_1_photo, $this->pengasuh_1_photo_path, 'settings/profil');
        $this->pengasuh_1_photo = null;
        $this->pengasuh_2_photo_path = $this->storeUpload($upload, $this->pengasuh_2_photo, $this->pengasuh_2_photo_path, 'settings/profil');
        $this->pengasuh_2_photo = null;

        $settings->setMany([
            'pengasuh_1_name' => $this->pengasuh_1_name,
            'pengasuh_1_title' => $this->pengasuh_1_title,
            'pengasuh_1_sambutan' => $this->pengasuh_1_sambutan,
            'pengasuh_1_photo' => $this->pengasuh_1_photo_path,
            'pengasuh_2_name' => $this->pengasuh_2_name,
            'pengasuh_2_title' => $this->pengasuh_2_title,
            'pengasuh_2_sambutan' => $this->pengasuh_2_sambutan,
            'pengasuh_2_photo' => $this->pengasuh_2_photo_path,
        ], 'profil');

        $this->toastSuccess('Data pengasuh berhasil disimpan.');
    }

    public function render()
    {
        return view('livewire.admin.website.pengasuh', [
            'photo1' => $this->pengasuh_1_photo_path ? Storage::disk('public')->url($this->pengasuh_1_photo_path) : null,
            'photo2' => $this->pengasuh_2_photo_path ? Storage::disk('public')->url($this->pengasuh_2_photo_path) : null,
        ]);
    }
}
