<?php

namespace Database\Seeders;

use App\Models\MiscDonation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MiscDonationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MiscDonation::factory(10)->create();
    }
}
