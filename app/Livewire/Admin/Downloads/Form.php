<?php

namespace App\Livewire\Admin\Downloads;

use App\Actions\GenerateSlugAction;
use App\Actions\UploadMediaAction;
use App\Models\Download;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Support\WithToast;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.admin')]
#[Title('Form Download')]
class Form extends Component
{
    use WithToast;

    use WithFileUploads;

    public ?Download $download = null;

    public string $title = '';

    public string $description = '';

    public string $slug = '';

    public string $category = '';

    public $file;

    public ?string $file_path = null;

    public int $file_size = 0;

    public function mount(?Download $download = null): void
    {
        if ($download?->exists) {
            $this->authorize('update', $download);
            $this->download = $download;
            $this->title = $download->title;
            $this->description = (string) $download->description;
            $this->slug = $download->slug;
            $this->category = (string) $download->category;
            $this->file_path = $download->file_path;
            $this->file_size = (int) $download->file_size;
        } else {
            $this->authorize('create', Download::class);
            $this->download = null;
        }
    }

    public function updatedTitle(string $value): void
    {
        if ($this->download === null) {
            $this->slug = app(GenerateSlugAction::class)->execute($value, new Download);
        }
    }

    public function save(GenerateSlugAction $slugger, UploadMediaAction $upload): void
    {
        if ($this->download) {
            $this->authorize('update', $this->download);
        } else {
            $this->authorize('create', Download::class);
        }

        $this->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('downloads', 'slug')->ignore($this->download?->id)],
            'category' => ['nullable', 'string', 'max:100'],
            'file' => [$this->download ? 'nullable' : 'required', 'file', 'max:20480'],
        ]);

        $slug = $slugger->execute($this->slug ?: $this->title, new Download, $this->download?->id);

        if ($this->file) {
            $upload->delete($this->file_path);
            $this->file_path = $upload->execute($this->file, 'downloads');
            $this->file_size = (int) $this->file->getSize();
            $this->file = null;
        }

        $data = [
            'title' => $this->title,
            'description' => $this->description ?: null,
            'slug' => $slug,
            'category' => $this->category ?: null,
            'file_path' => $this->file_path,
            'file_size' => $this->file_size,
        ];

        if ($this->download) {
            $this->download->update($data);
            $this->toastSuccess('Download berhasil diperbarui.');
        } else {
            Download::query()->create($data);
            $this->toastSuccess('Download berhasil ditambahkan.');
        }

        $this->redirect(route('admin.downloads.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.downloads.form');
    }
}
