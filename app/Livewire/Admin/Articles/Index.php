<?php

namespace App\Livewire\Admin\Articles;

use App\Models\Article;
use App\Support\WithSearch;
use App\Support\WithSorting;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Support\WithToast;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
#[Title('Artikel')]
class Index extends Component
{
    use WithToast;

    use WithPagination;
    use WithSearch;
    use WithSorting;

    public function mount(): void
    {
        $this->authorize('viewAny', Article::class);
    }

    public function delete(int $id): void
    {
        $article = Article::query()->findOrFail($id);
        $this->authorize('delete', $article);
        $article->delete();

        $this->toastSuccess('Artikel berhasil dihapus.');
    }

    public function render()
    {
        $articles = Article::query()
            ->with(['category', 'author'])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('title', 'like', '%'.$this->search.'%')
                        ->orWhere('slug', 'like', '%'.$this->search.'%');
                });
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        $stats = [
            'total' => Article::query()->count(),
            'draft' => Article::query()->where('status', \App\Enums\PublishStatus::Draft)->count(),
            'published' => Article::query()->where('status', \App\Enums\PublishStatus::Published)->count(),
        ];

        return view('livewire.admin.articles.index', compact('articles', 'stats'));
    }
}
