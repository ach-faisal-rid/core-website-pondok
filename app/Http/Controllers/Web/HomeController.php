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

        $admissionPhoto = $settings->get('home_admission_photo')
            ?: $settings->get('pengasuh_1_photo')
            ?: $settings->get('profil_founder_photo');

        return view('web.home', [
            'latestArticles' => $latestArticles,
            'heroImage' => $heroImage,
            'admissionPhoto' => $admissionPhoto,
            'heroTitle' => $settings->get('home_hero_title') ?: config('pondok.home.hero_title'),
            'heroSubtitle' => $settings->get('home_hero_subtitle') ?: config('pondok.home.hero_subtitle'),
            'stats' => config('pondok.home.stats'),
            'pancaJiwa' => config('pondok.profil.panca_jiwa'),
            'admissionTitle' => $settings->get('home_admission_title') ?: config('pondok.home.admission_title'),
            'admissionText' => $settings->get('home_admission_text') ?: config('pondok.home.admission_text'),
            'siteName' => $settings->get('site_name', config('app.name')),
        ]);
    }
}
