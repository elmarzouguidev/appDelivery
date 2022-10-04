<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */

    protected array $roles = [

        ['name' => 'SuperAdmin', 'guard_name' => 'admin'],
        
        ['name' => 'Admin', 'guard_name' => 'admin'],

        ['name' => 'Client', 'guard_name' => 'admin'],

        ['name' => 'Developper', 'guard_name' => 'admin'],

        ['name' => 'Delivery', 'guard_name' => 'admin'],

        ['name' => 'DeliveryEntreprise', 'guard_name' => 'admin'],

        ['name' => 'SubDelivery', 'guard_name' => 'delivery'],

    ];

    public function run()
    {
        foreach ($this->roles as $role) {
            Role::create($role);
        }
    }
}
