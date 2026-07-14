<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Article;
use App\Models\Content;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function __invoke(): Response
    {
        $contents = Content::query()->published()->latest('updated_at')->get();
        $articles = Article::query()->published()->latest('updated_at')->get();
        $albums = Album::query()->latest('updated_at')->get();

        $xml = view('web.sitemap', compact('contents', 'articles', 'albums'))->render();

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }
}
