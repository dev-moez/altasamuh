<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            [
                'email' => env('SUPER_ADMIN_EMAIL'),
            ],
            [
                'name' => 'Super Admin',
                'password' => bcrypt(env('SUPER_ADMIN_PASSWORD')),
            ]
        )->assignRole(Role::ROLE_SUPER_ADMIN);
    }
}
