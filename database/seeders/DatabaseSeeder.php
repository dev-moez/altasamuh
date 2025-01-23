<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\SuperAdminSeeder;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\ContactMessageSeeder;
use Database\Seeders\BoardMemberSeeder;
use Database\Seeders\GallerySeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\ArticleSeeder;
use Database\Seeders\HomeSliderSeeder;
use Database\Seeders\ProjectSeeder;
use Database\Seeders\MiscDonationSeeder;
use Database\Seeders\CountrySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            SuperAdminSeeder::class,
            CountrySeeder::class,
        ]);

        if (app()->environment('local')) {
            $this->call([
                CategorySeeder::class,
                ContactMessageSeeder::class,
                BoardMemberSeeder::class,
                GallerySeeder::class,
                ArticleSeeder::class,
                HomeSliderSeeder::class,
                ProjectSeeder::class,
                MiscDonationSeeder::class
            ]);
        }
    }
}
