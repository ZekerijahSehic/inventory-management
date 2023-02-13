<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Role::create(['name' => 'administrator']);
        Role::create(['name' => 'manager']);
        Role::create(['name' => 'user']);

        Permission::create(['name' => 'all-pages']);
        Permission::create(['name' => 'except-users']);
        Permission::create(['name' => 'home']);

        $adminRole = Role::findByName('administrator');

        $adminRole->givePermissionTo([
            'all-pages',
            'except-users',
            'home'
        ]);
    }
}
