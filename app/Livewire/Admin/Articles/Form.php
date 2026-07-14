<?php

namespace App\Livewire\Admin\Articles;

use App\Actions\GenerateSlugAction;
use App\Actions\PublishArticleAction;
use App\Actions\UploadMediaAction;
use App\Enums\ArticleType;
use App\Enums\PublishStatus;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Support\WithToast;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.admin')]
#[Title('Form Artikel')]
class Form extends Component
{
    use WithToast;

    use WithFileUploads;

    public ?Article $article = null;

    public string $title = '';

    public string $slug = '';

    public string $body = '';

    public string $type = 'berita';

    public ?int $category_id = null;

    public string $new_category = '';

    public string $tags_input = '';

    public string $status = 'draft';

    public ?string $published_at = null;

    public string $seo_title = '';

    public string $seo_description = '';

    public $thumbnail;

    public ?string $thumbnail_path = null;

    public function mount(?Article $article = null): void
    {
        if ($article?->exists) {
            $this->authorize('update', $article);
            $this->article = $article->load('tags');
            $this->title = $article->title;
            $this->slug = $article->slug;
            $this->body = (string) $article->body;
            $this->type = $article->type->value;
            $this->category_id = $article->category_id;
            $this->tags_input = $article->tags->pluck('name')->implode(', ');
            $this->status = $article->status->value;
            $this->published_at = $article->published_at?->format('Y-m-d\TH:i');
            $this->seo_title = (string) $article->seo_title;
            $this->seo_description = (string) $article->seo_description;
            $this->thumbnail_path = $article->thumbnail;
        } else {
            $this->authorize('create', Article::class);
            $this->article = null;
        }
    }

    public function updatedTitle(string $value): void
    {
        if ($this->article === null) {
            $this->slug = app(GenerateSlugAction::class)->execute($value, new Article);
        }
    }

    public function save(GenerateSlugAction $slugger, UploadMediaAction $upload, PublishArticleAction $publisher): void
    {
        if ($this->article) {
            $this->authorize('update', $this->article);
        } else {
            $this->authorize('create', Article::class);
        }

        $this->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('articles', 'slug')->ignore($this->article?->id)],
            'body' => ['nullable', 'string'],
            'type' => ['required', Rule::enum(ArticleType::class)],
            'category_id' => ['nullable', 'exists:categories,id'],
            'new_category' => ['nullable', 'string', 'max:255'],
            'tags_input' => ['nullable', 'string', 'max:500'],
            'status' => ['required', 'in:draft,published,scheduled'],
            'published_at' => ['nullable', 'date'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:500'],
            'thumbnail' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($this->new_category !== '') {
            $category = Category::query()->firstOrCreate(
                ['slug' => Str::slug($this->new_category)],
                ['name' => $this->new_category]
            );
            $this->category_id = $category->id;
            $this->new_category = '';
        }

        $slug = $slugger->execute($this->slug ?: $this->title, new Article, $this->article?->id);

        if ($this->thumbnail) {
            $upload->delete($this->thumbnail_path);
            $this->thumbnail_path = $upload->execute($this->thumbnail, 'articles');
            $this->thumbnail = null;
        }

        $data = [
            'title' => $this->title,
            'slug' => $slug,
            'body' => $this->body,
            'type' => ArticleType::from($this->type),
            'category_id' => $this->category_id,
            'author_id' => $this->article?->author_id ?? auth()->id(),
            'status' => PublishStatus::from($this->status),
            'published_at' => $this->published_at,
            'seo_title' => $this->seo_title ?: null,
            'seo_description' => $this->seo_description ?: null,
            'thumbnail' => $this->thumbnail_path,
        ];

        if ($this->article) {
            $this->article->update($data);
        } else {
            $this->article = Article::query()->create($data);
        }

        $tagIds = collect(explode(',', $this->tags_input))
            ->map(fn (string $tag) => trim($tag))
            ->filter()
            ->map(function (string $name) {
                return Tag::query()->firstOrCreate(
                    ['slug' => Str::slug($name)],
                    ['name' => $name]
                )->id;
            })
            ->all();

        $this->article->tags()->sync($tagIds);

        if ($this->status === PublishStatus::Published->value) {
            $publisher->execute(
                $this->article,
                $this->published_at ? new \DateTimeImmutable($this->published_at) : null
            );
        }

        $this->toastSuccess('Artikel berhasil disimpan.');

        $this->redirect(route('admin.articles.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.articles.form', [
            'categories' => Category::query()->orderBy('name')->get(),
            'types' => ArticleType::cases(),
            'statuses' => PublishStatus::cases(),
        ]);
    }
}
