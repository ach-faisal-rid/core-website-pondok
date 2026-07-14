<?php

namespace App\Livewire\Admin\Downloads;

use App\Actions\UploadMediaAction;
use App\Models\Download;
use App\Support\WithSearch;
use App\Support\WithSorting;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Support\WithToast;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
#[Title('Download')]
class Index extends Component
{
    use WithToast;

    use WithPagination;
    use WithSearch;
    use WithSorting;

    public function mount(): void
    {
        $this->authorize('viewAny', Download::class);
    }

    public function delete(int $id, UploadMediaAction $upload): void
    {
        $download = Download::query()->findOrFail($id);
        $this->authorize('delete', $download);
        $upload->delete($download->file_path);
        $download->delete();

        $this->toastSuccess('File download berhasil dihapus.');
    }

    public function render()
    {
        $downloads = Download::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('title', 'like', '%'.$this->search.'%')
                        ->orWhere('category', 'like', '%'.$this->search.'%')
                        ->orWhere('slug', 'like', '%'.$this->search.'%');
                });
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.admin.downloads.index', compact('downloads'));
    }
}
