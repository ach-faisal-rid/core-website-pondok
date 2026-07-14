<?php

namespace App\Livewire\Admin\Help;

use App\Enums\HelpCategory;
use App\Models\HelpArticle;
use Illuminate\Validation\Rule;
use App\Support\WithToast;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.admin')]
#[Title('Form Bantuan')]
class Form extends Component
{
    use WithToast;

    public ?HelpArticle $helpArticle = null;

    public string $title = '';

    public string $body = '';

    public string $category = 'umum';

    public int $sort_order = 0;

    public bool $is_published = true;

    public function mount(?HelpArticle $helpArticle = null): void
    {
        if ($helpArticle?->exists) {
            $this->authorize('update', $helpArticle);
            $this->helpArticle = $helpArticle;
            $this->title = $helpArticle->title;
            $this->body = (string) $helpArticle->body;
            $this->category = $helpArticle->category->value;
            $this->sort_order = $helpArticle->sort_order;
            $this->is_published = $helpArticle->is_published;
        } else {
            $this->authorize('create', HelpArticle::class);
            $this->helpArticle = null;
        }
    }

    public function save(): void
    {
        if ($this->helpArticle) {
            $this->authorize('update', $this->helpArticle);
        } else {
            $this->authorize('create', HelpArticle::class);
        }

        $validated = $this->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['nullable', 'string'],
            'category' => ['required', Rule::enum(HelpCategory::class)],
            'sort_order' => ['required', 'integer', 'min:0', 'max:9999'],
            'is_published' => ['boolean'],
        ]);

        if ($this->helpArticle) {
            $this->helpArticle->update($validated);
            $this->toastSuccess('Item bantuan berhasil diperbarui.');
        } else {
            HelpArticle::query()->create($validated);
            $this->toastSuccess('Item bantuan berhasil ditambahkan.');
        }

        $this->redirect(route('admin.help.manage'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.help.form', [
            'categories' => HelpCategory::cases(),
        ]);
    }
}
