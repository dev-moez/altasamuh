<?php

namespace Database\Seeders;

use App\Models\BoardMember;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BoardMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BoardMember::factory(10)->create();
    }
}
