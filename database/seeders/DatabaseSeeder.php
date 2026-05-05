<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // USERS
        User::factory()->create();

        //  PERMISSIONS
        Permission::firstOrCreate(['name' => 'product.view']);
        Permission::firstOrCreate(['name' => 'product.create']);
        Permission::firstOrCreate(['name' => 'product.edit']);
        Permission::firstOrCreate(['name' => 'product.delete']);

        Permission::firstOrCreate(['name' => 'category.view']);
        Permission::firstOrCreate(['name' => 'category.create']);
        Permission::firstOrCreate(['name' => 'category.edit']);
        Permission::firstOrCreate(['name' => 'category.delete']);

        // ROLES
        $superAdmin = Role::firstOrCreate(['name' => 'super-admin']);
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $staff = Role::firstOrCreate(['name' => 'staff']);

        //  ASSIGN PERMISSIONS

        $superAdmin->givePermissionTo(Permission::all());


        //  USERS

        $adminUser = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            ['name' => 'Admin', 'password' => bcrypt('12345678')]
        );
        $adminUser->assignRole('admin');

        $staffUser = User::firstOrCreate(
            ['email' => 'staff@gmail.com'],
            ['name' => 'Staff', 'password' => bcrypt('12345678')]
        );
        $staffUser->assignRole('staff');

        $superUser = User::firstOrCreate(
            ['email' => 'super@gmail.com'],
            ['name' => 'Super Admin', 'password' => bcrypt('12345678')]
        );
        $superUser->assignRole('super-admin');
    }
}

