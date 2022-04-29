<?php

namespace Database\Seeders;

use App\Models\Sameleon\User;
use Illuminate\Database\Seeder;

class AllSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(AdminSeeder::class);

        $users =  User::factory(100)->create();

        foreach ($users as $user) {
            
            $products = $user->products()->factory(100)->create();

            $products->stock()->factory(100)->create();
        }
    }
}
