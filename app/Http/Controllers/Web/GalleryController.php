<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public const FILTERS = [
        'Semua',
        'Kegiatan Santri',
        'Fasilitas',
        'Acara Tahunan',
        'Akademik',
    ];

    public function index(Request $request): View
    {
        $kategori = trim((string) $request->query('kategori', 'Semua'));

        if (! in_array($kategori, self::FILTERS, true)) {
            $kategori = 'Semua';
        }

        $query = Album::query()
            ->withCount('media')
            ->with(['media' => fn ($q) => $q->limit(1)])
            ->latest();

        if ($kategori !== 'Semua') {
            $query->where('category', $kategori);
        }

        $albums = $query->paginate(8)->withQueryString();

        return view('web.gallery.index', [
            'albums' => $albums,
            'filters' => self::FILTERS,
            'kategori' => $kategori,
            'subscribed' => $request->session()->pull('gallery_subscribed', false),
        ]);
    }

    public function show(string $slug): View
    {
        $album = Album::query()
            ->where('slug', $slug)
            ->with('media')
            ->firstOrFail();

        return view('web.gallery.show', compact('album'));
    }

    public function subscribe(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'max:255'],
        ]);

        ContactMessage::query()->create([
            'name' => 'Langganan Galeri',
            'email' => $validated['email'],
            'phone' => null,
            'subject' => 'Langganan dokumentasi galeri',
            'message' => 'Pengunjung meminta untuk mengikuti pembaruan dokumentasi galeri.',
            'is_read' => false,
        ]);

        return redirect()
            ->route('galeri.index', $request->only('kategori'))
            ->with('success', 'Terima kasih! Anda berhasil berlangganan.')
            ->with('gallery_subscribed', true);
    }
}
