<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Download;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DownloadController extends Controller
{
    public const FILTERS = [
        'Semua',
        'Administrasi',
        'Kurikulum',
        'Publikasi',
    ];

    public function index(Request $request): View
    {
        $q = trim((string) $request->query('q', ''));
        $kategori = trim((string) $request->query('kategori', 'Semua'));

        if (! in_array($kategori, self::FILTERS, true)) {
            $kategori = 'Semua';
        }

        $query = Download::query()->latest();

        if ($q !== '') {
            $query->where(function ($builder) use ($q) {
                $builder->where('title', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%")
                    ->orWhere('category', 'like', "%{$q}%");
            });
        }

        if ($kategori !== 'Semua') {
            $query->where('category', 'like', "%{$kategori}%");
        }

        $downloads = $query->get();

        $grouped = $downloads
            ->groupBy(fn (Download $download) => $download->category ?: 'Lainnya')
            ->sortKeys();

        return view('web.downloads.index', [
            'grouped' => $grouped,
            'filters' => self::FILTERS,
            'kategori' => $kategori,
            'q' => $q,
            'total' => $downloads->count(),
        ]);
    }

    public function file(Download $download): StreamedResponse
    {
        abort_unless(Storage::disk('public')->exists($download->file_path), 404);

        $download->incrementDownloadCount();

        return Storage::disk('public')->download(
            $download->file_path,
            basename($download->file_path)
        );
    }
}
