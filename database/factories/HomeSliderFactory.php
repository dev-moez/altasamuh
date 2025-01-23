<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\HomeSlider;
use Illuminate\Http\UploadedFile;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HomeSlider>
 */
class HomeSliderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'heading' => $this->faker->words(3, true),
            'sub_heading' => $this->faker->paragraph(2),
            'url' => $this->faker->url(),
            'display_order' => $this->faker->numberBetween(1, 10),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (HomeSlider $homeSlider) {
            $homeSlider->addMedia(UploadedFile::fake()->image('cover.jpg'))->toMediaCollection(HomeSlider::HOME_SLIDER_MEDIA_DESKTOP);
            $homeSlider->addMedia(UploadedFile::fake()->image('cover.jpg'))->toMediaCollection(HomeSlider::HOME_SLIDER_MEDIA_MOBILE);
        });
    }
}
