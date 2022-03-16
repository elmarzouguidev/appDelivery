<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {

    /*$this->call(RoleSeeder::class);
    $this->call(PermissionSeeder::class);
    $this->call(AdminSeeder::class);
    $this->call(ClientSeed::class);*/

    $this->call(CitySeeder::class);

    //\App\Models\Sameleon\Product::factory(5)->create();
  }
}
