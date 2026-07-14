<?php

namespace App\Livewire\Admin;

use App\Models\Album;
use App\Models\Article;
use App\Models\ContactMessage;
use App\Models\Content;
use App\Models\Download;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.admin')]
#[Title('Dashboard')]
class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.admin.dashboard', [
            'contentsCount' => Content::query()->count(),
            'articlesCount' => Article::query()->count(),
            'albumsCount' => Album::query()->count(),
            'downloadsCount' => Download::query()->count(),
            'unreadContactsCount' => ContactMessage::query()->where('is_read', false)->count(),
        ]);
    }
}
