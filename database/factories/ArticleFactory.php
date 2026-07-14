<?php

namespace Database\Factories;

use App\Enums\ArticleType;
use App\Enums\PublishStatus;
use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Article>
 */
class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition(): array
    {
        $title = fake()->sentence(6);

        return [
            'title' => $title,
            'slug' => Str::slug($title).'-'.fake()->unique()->numerify('####'),
            'body' => '<p>'.fake()->paragraphs(3, true).'</p>',
            'type' => ArticleType::Berita,
            'category_id' => null,
            'author_id' => User::factory(),
            'status' => PublishStatus::Draft,
            'published_at' => null,
            'thumbnail' => null,
            'seo_title' => null,
            'seo_description' => null,
        ];
    }

    public function published(): static
    {
        return $this->state(fn () => [
            'status' => PublishStatus::Published,
            'published_at' => now()->subDay(),
        ]);
    }

    public function draft(): static
    {
        return $this->state(fn () => [
            'status' => PublishStatus::Draft,
            'published_at' => null,
        ]);
    }

    public function scheduled(): static
    {
        return $this->state(fn () => [
            'status' => PublishStatus::Scheduled,
            'published_at' => now()->addDay(),
        ]);
    }
}
