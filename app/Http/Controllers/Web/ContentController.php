<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Content;
use Illuminate\View\View;

class ContentController extends Controller
{
    public function show(string $slug): View
    {
        $content = Content::query()
            ->published()
            ->where('slug', $slug)
            ->firstOrFail();

        return view('web.content.show', compact('content'));
    }
}
