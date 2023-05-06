<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = \App\Models\User::factory()->create([
            'name' => 'Surya Wana Bakti',
            'email' => 'surya@square',
        ]);

        $user2 = \App\Models\User::factory(10)->create();

        $roleSuper = Role::create(['name' => 'super-admin']);
        $roleAdmin = Role::create(['name' => 'admin']);

        $user->assignRole($roleSuper);
        // $user2->assignRole($roleAdmin);

        $permission = Permission::create(['name' => 'full-users']);

        $roleSuper->givePermissionTo($permission);
        $roleAdmin->givePermissionTo($permission);
    }
}
