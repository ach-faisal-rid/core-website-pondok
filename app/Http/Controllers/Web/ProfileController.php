<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Services\SettingService;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(SettingService $settings): View
    {
        $sejarah = Content::query()->published()->where('slug', 'sejarah')->first();
        $visiMisi = Content::query()->published()->where('slug', 'visi-misi')->first();
        $struktur = Content::query()->published()->where('slug', 'struktur-organisasi')->first();
        $profil = Content::query()->published()->where('slug', 'profil-pondok')->first();

        $heroImage = $settings->get('profil_hero')
            ?: ($profil?->thumbnail ?: $sejarah?->thumbnail);

        $founderImage = $settings->get('profil_founder_photo')
            ?: $sejarah?->thumbnail;

        $pengasuh = collect([1, 2])
            ->map(function (int $n) use ($settings) {
                return [
                    'name' => $settings->get("pengasuh_{$n}_name") ?: '',
                    'title' => $settings->get("pengasuh_{$n}_title") ?: '',
                    'photo' => $settings->get("pengasuh_{$n}_photo"),
                ];
            })
            ->filter(fn (array $item) => filled($item['name']))
            ->values();

        if ($pengasuh->isEmpty()) {
            $pengasuh = collect(config('pondok.profil.pengasuh', []))
                ->map(fn (array $item) => [
                    'name' => $item['name'] ?? '',
                    'title' => $item['title'] ?? '',
                    'photo' => null,
                ])
                ->filter(fn (array $item) => filled($item['name']))
                ->values();
        }

        return view('web.profil.index', [
            'sejarah' => $sejarah,
            'visiMisi' => $visiMisi,
            'struktur' => $struktur,
            'profil' => $profil,
            'heroImage' => $heroImage,
            'founderImage' => $founderImage,
            'visi' => $settings->get('profil_visi') ?: config('pondok.profil.visi'),
            'misi' => $this->misiItems($settings),
            'motto' => $settings->get('profil_motto'),
            'nilai' => $settings->get('profil_nilai'),
            'pancaJiwa' => $settings->json('profil_panca_jiwa', config('pondok.profil.panca_jiwa', [])),
            'pancaSectionTitle' => $settings->get('panca_section_title') ?: 'Panca Jiwa Pondok',
            'pengasuh' => $pengasuh,
            'heroSubtitle' => $settings->get('profil_hero_subtitle')
                ?: config('pondok.profil.hero_subtitle'),
            'siteName' => $settings->get('site_name', config('app.name')),
        ]);
    }

    /**
     * @return list<string>
     */
    private function misiItems(SettingService $settings): array
    {
        $fromSetting = $settings->json('profil_misi', []);

        if ($fromSetting !== []) {
            return array_values(array_filter(array_map('strval', $fromSetting)));
        }

        return config('pondok.profil.misi', []);
    }
}
