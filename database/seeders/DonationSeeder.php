<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DonationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Generate donations on all projects
        $projects = \App\Models\Project::all();
        foreach ($projects as $project) {
            for ($i = 1; $i <= 10; $i++) {
                \App\Models\Donation::factory()->create([
                    'donationable_id' => $project->id,
                    'donationable_type' => \App\Models\Project::class,
                ]);
            }
        }
    }
}
