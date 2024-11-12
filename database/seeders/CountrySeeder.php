<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Country::updateOrCreate([
            'name' => 'المملكة العربية السعودية',
            'code' => '966',
        ]);

        Country::updateOrCreate([
            'name' => 'الكويت',
            'code' => '965',
        ]);

        Country::updateOrCreate([
            'name' => 'الامارات العربية المتحدة',
            'code' => '971',
        ]);

        Country::updateOrCreate([
            'name' => 'قطر',
            'code' => '974',
        ]);

        Country::updateOrCreate([
            'name' => 'مصر',
            'code' => '20',
        ]);
    }
}
