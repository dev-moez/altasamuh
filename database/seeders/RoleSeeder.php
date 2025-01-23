<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::updateOrCreate(['name' => Role::ROLE_USER]);
        Role::updateOrCreate(['name' => Role::ROLE_ADMIN]);
        Role::updateOrCreate(['name' => Role::ROLE_SUPER_ADMIN]);
    }
}
