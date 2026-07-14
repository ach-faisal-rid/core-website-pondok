<?php

namespace App\Livewire\Admin\Help;

use App\Enums\HelpCategory;
use App\Models\HelpArticle;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.admin')]
#[Title('Bantuan')]
class Index extends Component
{
    public string $search = '';

    public function mount(): void
    {
        $this->authorize('viewAny', HelpArticle::class);
    }

    public function render()
    {
        $query = HelpArticle::query()->ordered();

        if (! auth()->user()->isAdmin()) {
            $query->published();
        }

        if ($this->search !== '') {
            $term = '%'.$this->search.'%';
            $query->where(function ($q) use ($term) {
                $q->where('title', 'like', $term)
                    ->orWhere('body', 'like', $term);
            });
        }

        $articles = $query->get()->groupBy(fn (HelpArticle $item) => $item->category->value);

        $grouped = collect(HelpCategory::ordered())
            ->map(function (HelpCategory $category) use ($articles) {
                $items = $articles->get($category->value, collect());

                return [
                    'category' => $category,
                    'items' => $items,
                ];
            })
            ->filter(fn (array $group) => $group['items']->isNotEmpty());

        return view('livewire.admin.help.index', [
            'grouped' => $grouped,
            'categories' => HelpCategory::cases(),
        ]);
    }
}
