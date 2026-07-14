<?php

use App\Http\Controllers\Web\ArticleController;
use App\Http\Controllers\Web\ContactController;
use App\Http\Controllers\Web\ContentController;
use App\Http\Controllers\Web\DownloadController;
use App\Http\Controllers\Web\GalleryController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\ProfileController;
use App\Http\Controllers\Web\SitemapController;
use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profil', [ProfileController::class, 'index'])->name('profil.index');
Route::get('/profil/{slug}', [ContentController::class, 'show'])->name('profil.show');
Route::get('/artikel', [ArticleController::class, 'index'])->name('artikel.index');
Route::get('/artikel/{slug}', [ArticleController::class, 'show'])->name('artikel.show');
Route::get('/galeri', [GalleryController::class, 'index'])->name('galeri.index');
Route::post('/galeri/langganan', [GalleryController::class, 'subscribe'])->name('galeri.subscribe');
Route::get('/galeri/{slug}', [GalleryController::class, 'show'])->name('galeri.show');
Route::get('/download', [DownloadController::class, 'index'])->name('download.index');
Route::get('/download/{download}/file', [DownloadController::class, 'file'])->name('download.file');
Route::get('/kontak', [ContactController::class, 'show'])->name('kontak');
Route::get('/sitemap.xml', SitemapController::class)->name('sitemap');

Route::redirect('dashboard', '/admin')->middleware(['auth'])->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::post('logout', function (Logout $logout) {
    $logout();

    return redirect()->route('home')->with('success', 'Berhasil keluar.');
})->middleware('auth')->name('logout');

require __DIR__.'/auth.php';
