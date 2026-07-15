<?php

namespace App\Livewire\Admin\Help;

use App\Enums\HelpCategory;
use App\Models\HelpArticle;
use App\Support\WithSearch;
use App\Support\WithSorting;
use App\Support\WithToast;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
#[Title('Kelola Bantuan')]
class Manage extends Component
{
    use WithPagination;
    use WithSearch;
    use WithSorting;
    use WithToast;

    public string $categoryFilter = '';

    public function mount(): void
    {
        $this->authorize('create', HelpArticle::class);
        $this->sortField = 'sort_order';
        $this->sortDirection = 'asc';
    }

    public function updatedCategoryFilter(): void
    {
        $this->resetPage();
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function delete(int $id): void
    {
        $article = HelpArticle::query()->findOrFail($id);
        $this->authorize('delete', $article);
        $article->delete();

        $this->toastSuccess('Item bantuan berhasil dihapus.');
    }

    public function render()
    {
        $articles = HelpArticle::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('title', 'like', '%'.$this->search.'%')
                        ->orWhere('body', 'like', '%'.$this->search.'%');
                });
            })
            ->when($this->categoryFilter !== '', fn ($query) => $query->where('category', $this->categoryFilter))
            ->orderBy($this->sortField, $this->sortDirection)
            ->orderBy('title')
            ->paginate(15);

        return view('livewire.admin.help.manage', [
            'articles' => $articles,
            'categories' => HelpCategory::ordered(),
        ]);
    }
}
