<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public const FILTERS = [
        'Semua',
        'Akademik',
        'Kegiatan',
        'Prestasi',
        'Opini',
    ];

    public function index(Request $request): View
    {
        $q = trim((string) $request->query('q', ''));
        $kategori = trim((string) $request->query('kategori', 'Semua'));

        if (! in_array($kategori, self::FILTERS, true)) {
            $kategori = 'Semua';
        }

        $articles = Article::query()
            ->published()
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($inner) use ($q) {
                    $inner->where('title', 'like', "%{$q}%")
                        ->orWhere('body', 'like', "%{$q}%");
                });
            })
            ->when($kategori !== 'Semua', function ($query) use ($kategori) {
                $query->whereHas('category', fn ($category) => $category->where('name', $kategori));
            })
            ->with(['category', 'author'])
            ->latest('published_at')
            ->latest('id')
            ->paginate(8)
            ->withQueryString();

        return view('web.articles.index', [
            'articles' => $articles,
            'q' => $q,
            'kategori' => $kategori,
            'filters' => self::FILTERS,
        ]);
    }

    public function show(string $slug): View
    {
        $article = Article::query()
            ->published()
            ->where('slug', $slug)
            ->with(['category', 'author', 'tags'])
            ->firstOrFail();

        return view('web.articles.show', compact('article'));
    }
}
