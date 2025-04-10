<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\Facility;
use Spatie\Permission\Models\Permission;

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

        Facility::create(['name' => 'Gym', 'description' => 'A place for physical exercise and fitness activities.', 'price' => 20.00]);
        Facility::create(['name' => 'Swimming Pool', 'description' => 'A pool for swimming and recreational activities.', 'price' => 15.00]);
        Facility::create(['name' => 'Parking Lot', 'description' => 'Designated area for parking vehicles.', 'price' => 5.00]);
        Facility::create(['name' => 'Playground', 'description' => 'An outdoor area for children to play.', 'price' => 10.00]);
        Facility::create(['name' => 'Tennis Court', 'description' => 'A court for playing tennis.', 'price' => 25.00]);
        Facility::create(['name' => 'Basketball Court', 'description' => 'A court for playing basketball.', 'price' => 30.00]);
        Facility::create(['name' => 'Club House', 'description' => 'A building for social gatherings and events.', 'price' => 50.00]);
        Facility::create(['name' => 'BBQ Area', 'description' => 'An area equipped for barbecuing.', 'price' => 40.00]);

        $permissions = [
            // roles
            'view roles', 'create roles', 'edit roles', 'delete roles',

            // users
            'view users', 'create users', 'edit users', 'delete users',

            // buildings
            'view buildings', 'create buildings', 'edit buildings', 'delete buildings',

            // floors
            'view floors', 'create floors', 'edit floors', 'delete floors',

            // units
            'view units', 'create units', 'edit units', 'delete units',

            // residents
            'view residents', 'create residents', 'edit residents', 'delete residents',

            // complaints
            'view own complaints', 'view All complaints',
            'create complaints', 'edit complaints', 'edit complaints Status', 'delete complaints',

            // notifications
            'view notifications',

            // facilities
            'view facilities', 'create facilities', 'edit facilities', 'delete facilities',

            // bookings
            'view All bookings', 'view own bookings', 'edit bookings', 'delete bookings',

            // permissions
            'view permissions', 'manage permissions',

            // reports
            'view reports',

            // bills
            'view bills', 'pay bills', 'payment callback',

            // booking payments
            'pay bookings', 'booking callback',

            // Notices
            'view notices', 'create notices', 'edit notices', 'delete notices',

        ];

        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
            $adminRole->givePermissionTo($permission);
        }
    }
}
