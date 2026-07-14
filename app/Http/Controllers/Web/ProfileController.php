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

        $pengasuh = collect(config('pondok.profil.pengasuh', []))
            ->map(function (array $item, int $index) use ($settings) {
                $n = $index + 1;

                return [
                    'name' => $settings->get("pengasuh_{$n}_name") ?: ($item['name'] ?? ''),
                    'title' => $settings->get("pengasuh_{$n}_title") ?: ($item['title'] ?? ''),
                    'photo' => $settings->get("pengasuh_{$n}_photo"),
                ];
            })
            ->filter(fn (array $item) => filled($item['name']))
            ->values();

        return view('web.profil.index', [
            'sejarah' => $sejarah,
            'visiMisi' => $visiMisi,
            'struktur' => $struktur,
            'profil' => $profil,
            'heroImage' => $heroImage,
            'founderImage' => $founderImage,
            'visi' => $settings->get('profil_visi') ?: config('pondok.profil.visi'),
            'misi' => $this->misiItems($settings, $visiMisi),
            'pancaJiwa' => config('pondok.profil.panca_jiwa'),
            'pengasuh' => $pengasuh,
            'heroSubtitle' => $settings->get('profil_hero_subtitle')
                ?: config('pondok.profil.hero_subtitle'),
            'siteName' => $settings->get('site_name', config('app.name')),
        ]);
    }

    /**
     * @return list<string>
     */
    private function misiItems(SettingService $settings, ?Content $visiMisi): array
    {
        $fromSetting = $settings->get('profil_misi');

        if (is_string($fromSetting) && filled($fromSetting)) {
            $decoded = json_decode($fromSetting, true);
            if (is_array($decoded) && $decoded !== []) {
                return array_values(array_filter(array_map('strval', $decoded)));
            }
        }

        return config('pondok.profil.misi', []);
    }
}
