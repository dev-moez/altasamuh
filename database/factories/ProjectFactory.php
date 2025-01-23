<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Project;
use Illuminate\Http\UploadedFile;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'display_in_navbar' => $this->faker->boolean,
            'display_in_homepage' => $this->faker->boolean,
            'title' => fake()->words(2, true),
            'description' => fake()->words(10, true),
            'details' => [
                'Prop 1' => fake()->words(2, true),
                'Prop 2' => fake()->words(2, true),
                'Prop 3' => fake()->words(2, true),
            ],
            'minimum_donation_value' => $this->faker->numberBetween(1, 20),
            'donationـofficer_name' => fake()->name(),
            'donationـofficer_number' => fake()->phoneNumber(),
            'required_donation_value' => $this->faker->numberBetween(100, 1000),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Project $project) {
            $project->addMedia(UploadedFile::fake()->image('cover.jpg'))->preservingOriginal()->toMediaCollection(Project::MEDIA_COLLECTION);
            $project->categories()->sync($this->faker->numberBetween(1, 5));
            $project->quickDonationValues()->create(['amount' => $this->faker->numberBetween(1, 20)]);
        });
    }
}
