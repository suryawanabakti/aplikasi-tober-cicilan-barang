<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\Pembayaran;
use App\Models\Pesanan;
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
            'name' => 'Admin',
            'email' => 'admin@admin',
            'password' => bcrypt('qwerty123'),
            'last_seen' => Carbon::now(),
        ]);

        $pimpinan = \App\Models\User::create([
            'name' => 'Pimpinan',
            'email' => 'pimpinan@pimpinan',
            'password' => bcrypt('qwerty123'),
            'last_seen' => Carbon::now(),
        ]);



        $roleAdmin = Role::create(['name' => 'admin']);
        $rolePimpinan = Role::create(['name' => 'pimpinan']);
        $roleCustomer = Role::create(['name' => 'customer']);

        $user->assignRole($roleAdmin);
        $pimpinan->assignRole($rolePimpinan);
    }
}
