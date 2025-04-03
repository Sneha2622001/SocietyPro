<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::create(['name' => 'Authenticated']);
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Resident']);
        Role::create(['name' => 'Security']);
        Role::create(['name' => 'Staff']);
    }
}
