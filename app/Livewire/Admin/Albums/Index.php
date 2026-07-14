<?php

namespace App\Livewire\Admin\Albums;

use App\Actions\UploadMediaAction;
use App\Models\Album;
use App\Models\Media;
use App\Support\WithSearch;
use App\Support\WithSorting;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Support\WithToast;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
#[Title('Galeri')]
class Index extends Component
{
    use WithToast;

    use WithPagination;
    use WithSearch;
    use WithSorting;

    public function mount(): void
    {
        $this->authorize('viewAny', Album::class);
    }

    public function delete(int $id, UploadMediaAction $upload): void
    {
        $album = Album::query()->with('media')->findOrFail($id);
        $this->authorize('delete', $album);

        foreach ($album->media as $media) {
            $upload->delete($media->path);
        }

        $upload->delete($album->thumbnail);
        $album->delete();

        $this->toastSuccess('Album berhasil dihapus.');
    }

    public function render()
    {
        $albums = Album::query()
            ->withCount('media')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('title', 'like', '%'.$this->search.'%')
                        ->orWhere('slug', 'like', '%'.$this->search.'%');
                });
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.admin.albums.index', compact('albums'));
    }
}
