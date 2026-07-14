<?php

namespace App\Providers;

use App\Models\Album;
use App\Models\Article;
use App\Models\ContactMessage;
use App\Models\Content;
use App\Models\Download;
use App\Models\Setting;
use App\Models\User;
use App\Policies\AlbumPolicy;
use App\Policies\ArticlePolicy;
use App\Policies\ContactMessagePolicy;
use App\Policies\ContentPolicy;
use App\Policies\DownloadPolicy;
use App\Policies\SettingPolicy;
use App\Policies\UserPolicy;
use App\Services\SettingService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(SettingService::class);
    }

    public function boot(): void
    {
        Gate::policy(Setting::class, SettingPolicy::class);
        Gate::policy(Content::class, ContentPolicy::class);
        Gate::policy(Article::class, ArticlePolicy::class);
        Gate::policy(Album::class, AlbumPolicy::class);
        Gate::policy(Download::class, DownloadPolicy::class);
        Gate::policy(ContactMessage::class, ContactMessagePolicy::class);
        Gate::policy(User::class, UserPolicy::class);

        view()->composer(['layouts.web', 'layouts.admin', 'web.*', 'errors.*'], function ($view) {
            $view->with('settings', app(SettingService::class)->all());
        });
    }
}
