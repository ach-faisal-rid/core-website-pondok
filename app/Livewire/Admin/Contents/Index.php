<?php

namespace App\Livewire\Admin\Contents;

use App\Models\Content;
use App\Support\WithSearch;
use App\Support\WithSorting;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Support\WithToast;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
#[Title('Konten')]
class Index extends Component
{
    use WithToast;

    use WithPagination;
    use WithSearch;
    use WithSorting;

    public function mount(): void
    {
        $this->authorize('viewAny', Content::class);
    }

    public function delete(int $id): void
    {
        $content = Content::query()->findOrFail($id);
        $this->authorize('delete', $content);
        $content->delete();

        $this->toastSuccess('Konten berhasil dihapus.');
    }

    public function render()
    {
        $contents = Content::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('title', 'like', '%'.$this->search.'%')
                        ->orWhere('slug', 'like', '%'.$this->search.'%');
                });
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.admin.contents.index', compact('contents'));
    }
}
