<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    protected $permissions = [

        ['name' => 'products.browse', 'guard_name' => 'admin'],
        ['name' => 'products.read', 'guard_name' => 'admin'],
        ['name' => 'products.create', 'guard_name' => 'admin'],
        ['name' => 'products.edit', 'guard_name' => 'admin'],
        ['name' => 'products.delete', 'guard_name' => 'admin'],

        ['name' => 'commands.browse', 'guard_name' => 'admin'],
        ['name' => 'commands.read', 'guard_name' => 'admin'],
        ['name' => 'commands.create', 'guard_name' => 'admin'],
        ['name' => 'commands.edit', 'guard_name' => 'admin'],
        ['name' => 'commands.delete', 'guard_name' => 'admin'],

        ['name' => 'invoices.browse', 'guard_name' => 'admin'],
        ['name' => 'invoices.read', 'guard_name' => 'admin'],
        ['name' => 'invoices.create', 'guard_name' => 'admin'],
        ['name' => 'invoices.edit', 'guard_name' => 'admin'],
        ['name' => 'invoices.delete', 'guard_name' => 'admin'],


        ['name' => 'payments.browse', 'guard_name' => 'admin'],
        ['name' => 'payments.read', 'guard_name' => 'admin'],
        ['name' => 'payments.create', 'guard_name' => 'admin'],
        ['name' => 'payments.edit', 'guard_name' => 'admin'],
        ['name' => 'payments.delete', 'guard_name' => 'admin'],

        ['name' => 'annonces.browse', 'guard_name' => 'admin'],
        ['name' => 'annonces.read', 'guard_name' => 'admin'],
        ['name' => 'annonces.create', 'guard_name' => 'admin'],
        ['name' => 'annonces.edit', 'guard_name' => 'admin'],
        ['name' => 'annonces.delete', 'guard_name' => 'admin'],

        ['name' => 'cities.browse', 'guard_name' => 'admin'],
        ['name' => 'cities.read', 'guard_name' => 'admin'],
        ['name' => 'cities.create', 'guard_name' => 'admin'],
        ['name' => 'cities.edit', 'guard_name' => 'admin'],
        ['name' => 'cities.delete', 'guard_name' => 'admin'],

        ['name' => 'settings.browse', 'guard_name' => 'admin'],
        ['name' => 'settings.read', 'guard_name' => 'admin'],
        ['name' => 'settings.create', 'guard_name' => 'admin'],
        ['name' => 'settings.edit', 'guard_name' => 'admin'],
        ['name' => 'settings.delete', 'guard_name' => 'admin'],

        ['name' => 'excel.import', 'guard_name' => 'admin'],

        ['name' => 'api.create', 'guard_name' => 'admin'],


    ];


    public function run()
    {

        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        foreach ($this->permissions as $permission) {

            Permission::create($permission);
        }

        $permissionsItems = Permission::all();

        $adminRole = Role::whereName('SuperAdmin')->first();

        $adminRole->syncPermissions($permissionsItems);
    }
}
