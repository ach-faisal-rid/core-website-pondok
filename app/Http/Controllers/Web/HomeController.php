<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Services\SettingService;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(SettingService $settings): View
    {
        $latestArticles = Article::query()
            ->published()
            ->with('category')
            ->latest('published_at')
            ->latest('id')
            ->limit(3)
            ->get();

        $heroImage = $settings->get('home_hero')
            ?: $settings->get('profil_hero');

        $stats = $settings->json('home_stats', config('pondok.home.stats', []));
        $pancaJiwa = $settings->json('profil_panca_jiwa', config('pondok.profil.panca_jiwa', []));

        return view('web.home', [
            'latestArticles' => $latestArticles,
            'heroImage' => $heroImage,
            'heroTitle' => $settings->get('home_hero_title') ?: config('pondok.home.hero_title'),
            'heroSubtitle' => $settings->get('home_hero_subtitle') ?: config('pondok.home.hero_subtitle'),
            'cta1Label' => $settings->get('home_cta1_label') ?: 'Jelajahi Profil',
            'cta1Url' => $settings->get('home_cta1_url') ?: route('profil.index'),
            'cta2Label' => $settings->get('home_cta2_label') ?: 'Hubungi Kami',
            'cta2Url' => $settings->get('home_cta2_url') ?: route('kontak'),
            'stats' => $stats,
            'pancaJiwa' => $pancaJiwa,
            'pancaSectionTitle' => $settings->get('panca_section_title') ?: 'Panca Jiwa Pondok',
            'pancaIntro' => $settings->get('home_panca_intro')
                ?: 'Lima nilai yang menjadi napas kehidupan santri dalam belajar, berkarya, dan berkhidmat.',
            'siteName' => $settings->get('site_name', config('app.name')),
        ]);
    }
}
