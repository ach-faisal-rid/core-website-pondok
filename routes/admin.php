<?php

use App\Livewire\Admin\Albums\Form as AlbumForm;
use App\Livewire\Admin\Albums\Index as AlbumIndex;
use App\Livewire\Admin\Articles\Form as ArticleForm;
use App\Livewire\Admin\Articles\Index as ArticleIndex;
use App\Livewire\Admin\Contacts\Index as ContactIndex;
use App\Livewire\Admin\Contacts\Show as ContactShow;
use App\Livewire\Admin\Contents\Form as ContentForm;
use App\Livewire\Admin\Contents\Index as ContentIndex;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Help\Form as HelpForm;
use App\Livewire\Admin\Help\Index as HelpIndex;
use App\Livewire\Admin\Help\Manage as HelpManage;
use App\Livewire\Admin\Downloads\Form as DownloadForm;
use App\Livewire\Admin\Downloads\Index as DownloadIndex;
use App\Livewire\Admin\Settings\Form as SettingsForm;
use App\Livewire\Admin\Users\Form as UserForm;
use App\Livewire\Admin\Users\Index as UserIndex;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', Dashboard::class)->name('dashboard');

    Route::get('/settings', SettingsForm::class)->name('settings')->middleware('role:admin');

    Route::get('/contents', ContentIndex::class)->name('contents.index');
    Route::get('/contents/create', ContentForm::class)->name('contents.create');
    Route::get('/contents/{content}/edit', ContentForm::class)->name('contents.edit');

    Route::get('/articles', ArticleIndex::class)->name('articles.index');
    Route::get('/articles/create', ArticleForm::class)->name('articles.create');
    Route::get('/articles/{article}/edit', ArticleForm::class)->name('articles.edit');

    Route::get('/albums', AlbumIndex::class)->name('albums.index');
    Route::get('/albums/create', AlbumForm::class)->name('albums.create');
    Route::get('/albums/{album}/edit', AlbumForm::class)->name('albums.edit');

    Route::get('/downloads', DownloadIndex::class)->name('downloads.index');
    Route::get('/downloads/create', DownloadForm::class)->name('downloads.create');
    Route::get('/downloads/{download}/edit', DownloadForm::class)->name('downloads.edit');

    Route::get('/contacts', ContactIndex::class)->name('contacts.index');
    Route::get('/contacts/{contactMessage}', ContactShow::class)->name('contacts.show');

    Route::get('/bantuan', HelpIndex::class)->name('help.index');
    Route::get('/bantuan/kelola', HelpManage::class)->name('help.manage');
    Route::get('/bantuan/buat', HelpForm::class)->name('help.create');
    Route::get('/bantuan/{helpArticle}/edit', HelpForm::class)->name('help.edit');

    Route::middleware('role:admin')->group(function () {
        Route::get('/users', UserIndex::class)->name('users.index');
        Route::get('/users/create', UserForm::class)->name('users.create');
        Route::get('/users/{user}/edit', UserForm::class)->name('users.edit');
    });
});
