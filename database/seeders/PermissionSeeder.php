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

        ['name' => 'products.browse', 'guard_name' => 'admin', 'type' => 'client'],
        ['name' => 'products.read', 'guard_name' => 'admin', 'type' => 'client'],
        ['name' => 'products.create', 'guard_name' => 'admin', 'type' => 'client'],
        ['name' => 'products.edit', 'guard_name' => 'admin', 'type' => 'client'],
        ['name' => 'products.delete', 'guard_name' => 'admin', 'type' => 'client'],

        ['name' => 'commands.browse', 'guard_name' => 'admin', 'type' => 'client'],
        ['name' => 'commands.read', 'guard_name' => 'admin', 'type' => 'client'],
        ['name' => 'commands.create', 'guard_name' => 'admin', 'type' => 'client'],
        ['name' => 'commands.edit', 'guard_name' => 'admin', 'type' => 'client'],
        ['name' => 'commands.delete', 'guard_name' => 'admin', 'type' => 'client'],

        ['name' => 'invoices.browse', 'guard_name' => 'admin', 'type' => 'client'],
        ['name' => 'invoices.read', 'guard_name' => 'admin', 'type' => 'client'],
        ['name' => 'invoices.create', 'guard_name' => 'admin', 'type' => 'client'],
        ['name' => 'invoices.edit', 'guard_name' => 'admin', 'type' => 'client'],
        ['name' => 'invoices.delete', 'guard_name' => 'admin', 'type' => 'client'],

        ['name' => 'payments.browse', 'guard_name' => 'admin', 'type' => 'client'],
        ['name' => 'payments.read', 'guard_name' => 'admin', 'type' => 'client'],
        ['name' => 'payments.create', 'guard_name' => 'admin', 'type' => 'client'],
        ['name' => 'payments.edit', 'guard_name' => 'admin', 'type' => 'client'],
        ['name' => 'payments.delete', 'guard_name' => 'admin', 'type' => 'client'],

        ['name' => 'excel.import', 'guard_name' => 'admin', 'type' => 'client'],

        ['name' => 'api.create', 'guard_name' => 'admin', 'type' => 'client'],

        ['name' => 'annonces.browse', 'guard_name' => 'admin', 'type' => 'admin'],
        ['name' => 'annonces.read', 'guard_name' => 'admin', 'type' => 'admin'],
        ['name' => 'annonces.create', 'guard_name' => 'admin', 'type' => 'admin'],
        ['name' => 'annonces.edit', 'guard_name' => 'admin', 'type' => 'admin'],
        ['name' => 'annonces.delete', 'guard_name' => 'admin', 'type' => 'admin'],

        ['name' => 'cities.browse', 'guard_name' => 'admin', 'type' => 'admin'],
        ['name' => 'cities.read', 'guard_name' => 'admin', 'type' => 'admin'],
        ['name' => 'cities.create', 'guard_name' => 'admin', 'type' => 'admin'],
        ['name' => 'cities.edit', 'guard_name' => 'admin', 'type' => 'admin'],
        ['name' => 'cities.delete', 'guard_name' => 'admin', 'type' => 'admin'],

        ['name' => 'settings.browse', 'guard_name' => 'admin', 'type' => 'admin'],
        ['name' => 'settings.read', 'guard_name' => 'admin', 'type' => 'admin'],
        ['name' => 'settings.create', 'guard_name' => 'admin', 'type' => 'admin'],
        ['name' => 'settings.edit', 'guard_name' => 'admin', 'type' => 'admin'],
        ['name' => 'settings.delete', 'guard_name' => 'admin', 'type' => 'admin'],

    ];

    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        foreach ($this->permissions as $permission) {
            Permission::create($permission);
        }

        $permissionsAdminItems = Permission::whereType('admin')->get();

        $adminRole = Role::whereName('SuperAdmin')->first();

        $adminRole->syncPermissions($permissionsAdminItems);
    }
}
