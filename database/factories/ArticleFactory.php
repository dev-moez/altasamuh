<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Article;
use Illuminate\Http\UploadedFile;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->words(2, true),
            'content' => fake()->paragraphs(3, true),
            'is_published' => fake()->boolean(),
            'is_pinned' => fake()->boolean(),
            'slug' => fake()->slug(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Article $article) {
            $article->addMedia(UploadedFile::fake()->image('cover.jpg'))->preservingOriginal()->toMediaCollection(Article::MEDIA_COVER);
        });
    }
}
