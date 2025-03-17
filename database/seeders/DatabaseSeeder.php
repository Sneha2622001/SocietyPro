<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $adminRole = Role::create(['name' => 'Admin']);
        $residentRole = Role::create(['name' => 'Resident']);
        $securityRole = Role::create(['name' => 'Security']);
        $staffRole = Role::create(['name' => 'Staff']);
    
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role_id' => $adminRole->id,
        ]);
    
        User::factory()->create([
            'name' => 'Resident User',
            'email' => 'resident@example.com',
            'password' => bcrypt('password'),
            'role_id' => $residentRole->id,
        ]);
    
        User::factory()->create([
            'name' => 'Security User',
            'email' => 'security@example.com',
            'password' => bcrypt('password'),
            'role_id' => $securityRole->id,
        ]);
    
        User::factory()->create([
            'name' => 'Staff User',
            'email' => 'staff@example.com',
            'password' => bcrypt('password'),
            'role_id' => $staffRole->id,
        ]);
    }
}
