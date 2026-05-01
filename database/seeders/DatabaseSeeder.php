<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
// use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
   public function run(): void
    {
        // products
            User::factory()->count(5)->create();
        

        // roles
        $adminRole = Role::firstOrCreate();
        $staffRole = Role::firstOrCreate();

        // admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            ['name' => 'Admin', 'password' => bcrypt('12345678')]
        );

        if (!$admin->hasRole($adminRole)) {
            $admin->assignRole($adminRole);
        }

        // staff
        $staffUser = User::firstOrCreate(
            ['email' => 'staff@gmail.com'],
            ['name' => 'Staff', 'password' => bcrypt('12345678')]
        );

        if (!$staffUser->hasRole($staffRole)) {
            $staffUser->assignRole($staffRole);
        }

        // test user
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            ['name' => 'Test User', 'password' => bcrypt('12345678')]
        );
    }
}
