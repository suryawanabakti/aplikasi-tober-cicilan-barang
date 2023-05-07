<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;



// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = \App\Models\User::create([
            // 'id' => Str::uuid(),
            'name' => 'Surya Wana Bakti',
            'email' => 'surya@square',
            'password' => bcrypt('qwerty123'),
            'last_seen' => Carbon::now(),
            'position' => 'super admin'
        ]);

        $usera = \App\Models\User::factory(5)->create();



        $roleSuper = Role::create(['name' => 'super-admin']);
        $roleAdmin = Role::create(['name' => 'admin']);

        $user->assignRole($roleSuper);


        $permission = Permission::create(['name' => 'full-users']);

        $roleSuper->givePermissionTo($permission);
        // $roleAdmin->givePermissionTo($permission);
    }
}
