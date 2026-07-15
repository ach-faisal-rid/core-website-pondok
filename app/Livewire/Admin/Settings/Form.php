<?php

namespace App\Livewire\Admin\Settings;

use App\Actions\UploadMediaAction;
use App\Models\Setting;
use App\Services\SettingService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Support\WithToast;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.admin')]
#[Title('Pengaturan')]
class Form extends Component
{
    use WithFileUploads;
    use WithToast;

    public string $activeTab = 'umum';

    /** @var list<string> */
    public array $iconOptions = ['heart', 'leaf', 'hand', 'users', 'wind', 'book', 'building', 'calendar', 'star'];

    // Umum
    public string $site_name = '';

    public string $site_tagline = '';

    public $logo;

    public ?string $logo_path = null;

    public $favicon;

    public ?string $favicon_path = null;

    public string $footer_text = '';

    public string $seo_title = '';

    public string $seo_description = '';

    // Beranda
    public string $home_hero_title = '';

    public string $home_hero_subtitle = '';

    public string $home_cta1_label = '';

    public string $home_cta1_url = '';

    public string $home_cta2_label = '';

    public string $home_cta2_url = '';

    public $home_hero;

    public ?string $home_hero_path = null;

    public string $home_panca_intro = '';

    /** @var list<array{value: string, label: string, icon: string}> */
    public array $stats = [];

    // Profil
    public string $profil_hero_subtitle = '';

    public $profil_hero;

    public ?string $profil_hero_path = null;

    public $profil_founder_photo;

    public ?string $profil_founder_photo_path = null;

    public string $profil_visi = '';

    /** @var list<string> */
    public array $misi = [];

    public string $profil_motto = '';

    public string $profil_nilai = '';

    public string $panca_section_title = '';

    /** @var list<array{title: string, description: string, icon: string}> */
    public array $panca_jiwa = [];

    public string $pengasuh_1_name = '';

    public string $pengasuh_1_title = '';

    public $pengasuh_1_photo;

    public ?string $pengasuh_1_photo_path = null;

    public string $pengasuh_2_name = '';

    public string $pengasuh_2_title = '';

    public $pengasuh_2_photo;

    public ?string $pengasuh_2_photo_path = null;

    // Kontak
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

        $this->home_hero_title = (string) ($settings->get('home_hero_title') ?: config('pondok.home.hero_title'));
        $this->home_hero_subtitle = (string) ($settings->get('home_hero_subtitle') ?: config('pondok.home.hero_subtitle'));
        $this->home_cta1_label = (string) $settings->get('home_cta1_label', 'Jelajahi Profil');
        $this->home_cta1_url = (string) $settings->get('home_cta1_url', '/profil');
        $this->home_cta2_label = (string) $settings->get('home_cta2_label', 'Hubungi Kami');
        $this->home_cta2_url = (string) $settings->get('home_cta2_url', '/kontak');
        $this->home_hero_path = $settings->get('home_hero');
        $this->home_panca_intro = (string) $settings->get(
            'home_panca_intro',
            'Lima nilai yang menjadi napas kehidupan santri dalam belajar, berkarya, dan berkhidmat.'
        );

        $stats = $settings->json('home_stats', config('pondok.home.stats', []));
        $this->stats = collect($stats)->map(fn ($item) => [
            'value' => (string) ($item['value'] ?? ''),
            'label' => (string) ($item['label'] ?? ''),
            'icon' => (string) ($item['icon'] ?? 'users'),
        ])->values()->all();

        if ($this->stats === []) {
            $this->stats = [
                ['value' => '1000+', 'label' => 'Santri Aktif', 'icon' => 'users'],
                ['value' => '40+ Tahun', 'label' => 'Pengabdian Pendidikan', 'icon' => 'calendar'],
                ['value' => '10+ Cabang', 'label' => 'Di Seluruh Indonesia', 'icon' => 'building'],
            ];
        }

        $this->profil_hero_subtitle = (string) ($settings->get('profil_hero_subtitle') ?: config('pondok.profil.hero_subtitle'));
        $this->profil_hero_path = $settings->get('profil_hero');
        $this->profil_founder_photo_path = $settings->get('profil_founder_photo');
        $this->profil_visi = (string) ($settings->get('profil_visi') ?: config('pondok.profil.visi'));
        $this->profil_motto = (string) $settings->get('profil_motto', '');
        $this->profil_nilai = (string) $settings->get('profil_nilai', '');
        $this->panca_section_title = (string) $settings->get('panca_section_title', 'Panca Jiwa Pondok');

        $misi = $settings->json('profil_misi', config('pondok.profil.misi', []));
        $this->misi = array_values(array_map('strval', $misi));
        if ($this->misi === []) {
            $this->misi = [''];
        }

        $panca = $settings->json('profil_panca_jiwa', config('pondok.profil.panca_jiwa', []));
        $this->panca_jiwa = collect($panca)->map(fn ($item) => [
            'title' => (string) ($item['title'] ?? ''),
            'description' => (string) ($item['description'] ?? ''),
            'icon' => (string) ($item['icon'] ?? 'heart'),
        ])->values()->all();

        if ($this->panca_jiwa === []) {
            $this->panca_jiwa = [
                ['title' => '', 'description' => '', 'icon' => 'heart'],
            ];
        }

        $this->pengasuh_1_name = (string) $settings->get('pengasuh_1_name', '');
        $this->pengasuh_1_title = (string) $settings->get('pengasuh_1_title', '');
        $this->pengasuh_1_photo_path = $settings->get('pengasuh_1_photo');
        $this->pengasuh_2_name = (string) $settings->get('pengasuh_2_name', '');
        $this->pengasuh_2_title = (string) $settings->get('pengasuh_2_title', '');
        $this->pengasuh_2_photo_path = $settings->get('pengasuh_2_photo');

        $this->phone = (string) $settings->get('phone', '');
        $this->whatsapp = (string) $settings->get('whatsapp', '');
        $this->email = (string) $settings->get('email', '');
        $this->address = (string) $settings->get('address', '');
        $this->maps_embed = (string) $settings->get('maps_embed', '');
        $this->facebook = (string) $settings->get('facebook', '');
        $this->instagram = (string) $settings->get('instagram', '');
        $this->youtube = (string) $settings->get('youtube', '');
    }

    public function setTab(string $tab): void
    {
        if (in_array($tab, ['umum', 'beranda', 'profil', 'kontak'], true)) {
            $this->activeTab = $tab;
        }
    }

    public function addStat(): void
    {
        $this->stats[] = ['value' => '', 'label' => '', 'icon' => 'users'];
    }

    public function removeStat(int $index): void
    {
        unset($this->stats[$index]);
        $this->stats = array_values($this->stats);
    }

    public function addMisi(): void
    {
        $this->misi[] = '';
    }

    public function removeMisi(int $index): void
    {
        unset($this->misi[$index]);
        $this->misi = array_values($this->misi);
        if ($this->misi === []) {
            $this->misi = [''];
        }
    }

    public function addPanca(): void
    {
        $this->panca_jiwa[] = ['title' => '', 'description' => '', 'icon' => 'heart'];
    }

    public function removePanca(int $index): void
    {
        unset($this->panca_jiwa[$index]);
        $this->panca_jiwa = array_values($this->panca_jiwa);
        if ($this->panca_jiwa === []) {
            $this->panca_jiwa = [['title' => '', 'description' => '', 'icon' => 'heart']];
        }
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
            'home_hero_title' => ['nullable', 'string', 'max:500'],
            'home_hero_subtitle' => ['nullable', 'string', 'max:1000'],
            'home_cta1_label' => ['nullable', 'string', 'max:100'],
            'home_cta1_url' => ['nullable', 'string', 'max:255'],
            'home_cta2_label' => ['nullable', 'string', 'max:100'],
            'home_cta2_url' => ['nullable', 'string', 'max:255'],
            'home_hero' => ['nullable', 'image', 'max:4096'],
            'home_panca_intro' => ['nullable', 'string', 'max:500'],
            'stats' => ['array'],
            'stats.*.value' => ['nullable', 'string', 'max:50'],
            'stats.*.label' => ['nullable', 'string', 'max:100'],
            'stats.*.icon' => ['nullable', Rule::in($this->iconOptions)],
            'profil_hero_subtitle' => ['nullable', 'string', 'max:500'],
            'profil_hero' => ['nullable', 'image', 'max:4096'],
            'profil_founder_photo' => ['nullable', 'image', 'max:4096'],
            'profil_visi' => ['nullable', 'string', 'max:2000'],
            'misi' => ['array'],
            'misi.*' => ['nullable', 'string', 'max:500'],
            'profil_motto' => ['nullable', 'string', 'max:500'],
            'profil_nilai' => ['nullable', 'string', 'max:2000'],
            'panca_section_title' => ['nullable', 'string', 'max:100'],
            'panca_jiwa' => ['array'],
            'panca_jiwa.*.title' => ['nullable', 'string', 'max:100'],
            'panca_jiwa.*.description' => ['nullable', 'string', 'max:500'],
            'panca_jiwa.*.icon' => ['nullable', Rule::in($this->iconOptions)],
            'pengasuh_1_name' => ['nullable', 'string', 'max:255'],
            'pengasuh_1_title' => ['nullable', 'string', 'max:255'],
            'pengasuh_1_photo' => ['nullable', 'image', 'max:4096'],
            'pengasuh_2_name' => ['nullable', 'string', 'max:255'],
            'pengasuh_2_title' => ['nullable', 'string', 'max:255'],
            'pengasuh_2_photo' => ['nullable', 'image', 'max:4096'],
            'phone' => ['nullable', 'string', 'max:50'],
            'whatsapp' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'address' => ['nullable', 'string', 'max:1000'],
            'maps_embed' => ['nullable', 'string'],
            'facebook' => ['nullable', 'url', 'max:255'],
            'instagram' => ['nullable', 'url', 'max:255'],
            'youtube' => ['nullable', 'url', 'max:255'],
        ]);

        $this->home_hero_path = $this->storeUpload($upload, $this->home_hero, $this->home_hero_path, 'settings/home');
        $this->home_hero = null;
        $this->profil_hero_path = $this->storeUpload($upload, $this->profil_hero, $this->profil_hero_path, 'settings/profil');
        $this->profil_hero = null;
        $this->profil_founder_photo_path = $this->storeUpload($upload, $this->profil_founder_photo, $this->profil_founder_photo_path, 'settings/profil');
        $this->profil_founder_photo = null;
        $this->pengasuh_1_photo_path = $this->storeUpload($upload, $this->pengasuh_1_photo, $this->pengasuh_1_photo_path, 'settings/profil');
        $this->pengasuh_1_photo = null;
        $this->pengasuh_2_photo_path = $this->storeUpload($upload, $this->pengasuh_2_photo, $this->pengasuh_2_photo_path, 'settings/profil');
        $this->pengasuh_2_photo = null;
        $this->logo_path = $this->storeUpload($upload, $this->logo, $this->logo_path, 'settings');
        $this->logo = null;
        $this->favicon_path = $this->storeUpload($upload, $this->favicon, $this->favicon_path, 'settings');
        $this->favicon = null;

        $stats = collect($this->stats)
            ->map(fn ($item) => [
                'value' => trim((string) ($item['value'] ?? '')),
                'label' => trim((string) ($item['label'] ?? '')),
                'icon' => (string) ($item['icon'] ?? 'users'),
            ])
            ->filter(fn ($item) => $item['value'] !== '' || $item['label'] !== '')
            ->values()
            ->all();

        $misi = collect($this->misi)
            ->map(fn ($item) => trim((string) $item))
            ->filter()
            ->values()
            ->all();

        $panca = collect($this->panca_jiwa)
            ->map(fn ($item) => [
                'title' => trim((string) ($item['title'] ?? '')),
                'description' => trim((string) ($item['description'] ?? '')),
                'icon' => (string) ($item['icon'] ?? 'heart'),
            ])
            ->filter(fn ($item) => $item['title'] !== '' || $item['description'] !== '')
            ->values()
            ->all();

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
            'home_hero_title' => $this->home_hero_title,
            'home_hero_subtitle' => $this->home_hero_subtitle,
            'home_cta1_label' => $this->home_cta1_label,
            'home_cta1_url' => $this->home_cta1_url,
            'home_cta2_label' => $this->home_cta2_label,
            'home_cta2_url' => $this->home_cta2_url,
            'home_hero' => $this->home_hero_path,
            'home_panca_intro' => $this->home_panca_intro,
            'home_stats' => $stats,
        ], 'home');

        $settings->setMany([
            'profil_hero_subtitle' => $this->profil_hero_subtitle,
            'profil_hero' => $this->profil_hero_path,
            'profil_founder_photo' => $this->profil_founder_photo_path,
            'profil_visi' => $this->profil_visi,
            'profil_misi' => $misi,
            'profil_motto' => $this->profil_motto,
            'profil_nilai' => $this->profil_nilai,
            'panca_section_title' => $this->panca_section_title,
            'profil_panca_jiwa' => $panca,
            'pengasuh_1_name' => $this->pengasuh_1_name,
            'pengasuh_1_title' => $this->pengasuh_1_title,
            'pengasuh_1_photo' => $this->pengasuh_1_photo_path,
            'pengasuh_2_name' => $this->pengasuh_2_name,
            'pengasuh_2_title' => $this->pengasuh_2_title,
            'pengasuh_2_photo' => $this->pengasuh_2_photo_path,
        ], 'profil');

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

    private function storeUpload(UploadMediaAction $upload, mixed $file, ?string $current, string $folder): ?string
    {
        if (! $file) {
            return $current;
        }

        $upload->delete($current);

        return $upload->execute($file, $folder);
    }

    public function render()
    {
        return view('livewire.admin.settings.form', [
            'logoUrl' => $this->logo_path ? Storage::disk('public')->url($this->logo_path) : null,
            'faviconUrl' => $this->favicon_path ? Storage::disk('public')->url($this->favicon_path) : null,
            'homeHeroUrl' => $this->home_hero_path ? Storage::disk('public')->url($this->home_hero_path) : null,
            'profilHeroUrl' => $this->profil_hero_path ? Storage::disk('public')->url($this->profil_hero_path) : null,
            'founderUrl' => $this->profil_founder_photo_path ? Storage::disk('public')->url($this->profil_founder_photo_path) : null,
            'pengasuh1Url' => $this->pengasuh_1_photo_path ? Storage::disk('public')->url($this->pengasuh_1_photo_path) : null,
            'pengasuh2Url' => $this->pengasuh_2_photo_path ? Storage::disk('public')->url($this->pengasuh_2_photo_path) : null,
        ]);
    }
}
