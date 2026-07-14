<?php

namespace App\Livewire\Admin\Contents;

use App\Actions\GenerateSlugAction;
use App\Actions\UploadMediaAction;
use App\Enums\PublishStatus;
use App\Models\Content;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Support\WithToast;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.admin')]
#[Title('Form Konten')]
class Form extends Component
{
    use WithToast;

    use WithFileUploads;

    public ?Content $content = null;

    public string $title = '';

    public string $slug = '';

    public string $body = '';

    public string $status = 'draft';

    public string $seo_title = '';

    public string $seo_description = '';

    public $thumbnail;

    public ?string $thumbnail_path = null;

    public function mount(?Content $content = null): void
    {
        if ($content?->exists) {
            $this->authorize('update', $content);
            $this->content = $content;
            $this->title = $content->title;
            $this->slug = $content->slug;
            $this->body = (string) $content->body;
            $this->status = $content->status->value;
            $this->seo_title = (string) $content->seo_title;
            $this->seo_description = (string) $content->seo_description;
            $this->thumbnail_path = $content->thumbnail;
        } else {
            $this->authorize('create', Content::class);
            $this->content = null;
        }
    }

    public function updatedTitle(string $value): void
    {
        if ($this->content === null) {
            $this->slug = app(GenerateSlugAction::class)->execute($value, new Content);
        }
    }

    public function save(GenerateSlugAction $slugger, UploadMediaAction $upload): void
    {
        if ($this->content) {
            $this->authorize('update', $this->content);
        } else {
            $this->authorize('create', Content::class);
        }

        $this->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('contents', 'slug')->ignore($this->content?->id)],
            'body' => ['nullable', 'string'],
            'status' => ['required', 'in:draft,published'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:500'],
            'thumbnail' => ['nullable', 'image', 'max:2048'],
        ]);

        $slug = $slugger->execute($this->slug ?: $this->title, new Content, $this->content?->id);

        if ($this->thumbnail) {
            $upload->delete($this->thumbnail_path);
            $this->thumbnail_path = $upload->execute($this->thumbnail, 'contents');
            $this->thumbnail = null;
        }

        $data = [
            'title' => $this->title,
            'slug' => $slug,
            'body' => $this->body,
            'status' => PublishStatus::from($this->status),
            'seo_title' => $this->seo_title ?: null,
            'seo_description' => $this->seo_description ?: null,
            'thumbnail' => $this->thumbnail_path,
            'type' => 'page',
        ];

        if ($this->content) {
            $this->content->update($data);
            $this->toastSuccess('Konten berhasil diperbarui.');
        } else {
            $this->content = Content::query()->create($data);
            $this->toastSuccess('Konten berhasil dibuat.');
        }

        $this->redirect(route('admin.contents.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.contents.form');
    }
}
