<?php

namespace App\Livewire\Admin\Albums;

use App\Actions\GenerateSlugAction;
use App\Actions\UploadMediaAction;
use App\Enums\MediaType;
use App\Models\Album;
use App\Models\Media;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Support\WithToast;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.admin')]
#[Title('Form Album')]
class Form extends Component
{
    use WithToast;

    use WithFileUploads;

    public ?Album $album = null;

    public string $title = '';

    public string $slug = '';

    public string $description = '';

    public string $category = '';

    public $thumbnail;

    public ?string $thumbnail_path = null;

    /** @var array<int, \Livewire\Features\SupportFileUploads\TemporaryUploadedFile> */
    public array $photos = [];

    public function mount(?Album $album = null): void
    {
        if ($album?->exists) {
            $this->authorize('update', $album);
            $this->album = $album->load('media');
            $this->title = $album->title;
            $this->slug = $album->slug;
            $this->description = (string) $album->description;
            $this->category = (string) $album->category;
            $this->thumbnail_path = $album->thumbnail;
        } else {
            $this->authorize('create', Album::class);
            $this->album = null;
        }
    }

    public function updatedTitle(string $value): void
    {
        if ($this->album === null) {
            $this->slug = app(GenerateSlugAction::class)->execute($value, new Album);
        }
    }

    public function deletePhoto(int $mediaId, UploadMediaAction $upload): void
    {
        if (! $this->album) {
            return;
        }

        $this->authorize('update', $this->album);

        $media = Media::query()
            ->where('album_id', $this->album->id)
            ->findOrFail($mediaId);

        $upload->delete($media->path);
        $media->delete();

        $this->album->load('media');
        $this->toastSuccess('Foto berhasil dihapus.');
    }

    public function save(GenerateSlugAction $slugger, UploadMediaAction $upload): void
    {
        if ($this->album) {
            $this->authorize('update', $this->album);
        } else {
            $this->authorize('create', Album::class);
        }

        $this->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('albums', 'slug')->ignore($this->album?->id)],
            'description' => ['nullable', 'string'],
            'category' => ['nullable', 'string', Rule::in(Album::CATEGORIES)],
            'thumbnail' => ['nullable', 'image', 'max:2048'],
            'photos' => ['nullable', 'array'],
            'photos.*' => ['image', 'max:4096'],
        ]);

        $slug = $slugger->execute($this->slug ?: $this->title, new Album, $this->album?->id);

        if ($this->thumbnail) {
            $upload->delete($this->thumbnail_path);
            $this->thumbnail_path = $upload->execute($this->thumbnail, 'albums');
            $this->thumbnail = null;
        }

        $data = [
            'title' => $this->title,
            'slug' => $slug,
            'description' => $this->description ?: null,
            'category' => $this->category ?: null,
            'thumbnail' => $this->thumbnail_path,
        ];

        if ($this->album) {
            $this->album->update($data);
        } else {
            $this->album = Album::query()->create($data);
        }

        if ($this->photos !== []) {
            $sortOrder = (int) $this->album->media()->max('sort_order');

            foreach ($this->photos as $photo) {
                $path = $upload->execute($photo, 'albums/'.$this->album->id);
                Media::query()->create([
                    'album_id' => $this->album->id,
                    'type' => MediaType::Photo,
                    'path' => $path,
                    'sort_order' => ++$sortOrder,
                ]);
            }

            $this->photos = [];
        }

        $this->toastSuccess('Album berhasil disimpan.');

        $this->redirect(route('admin.albums.edit', $this->album), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.albums.form');
    }
}
