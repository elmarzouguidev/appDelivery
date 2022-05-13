<?php

namespace Database\Seeders;

use App\Models\Sameleon\Product;
use App\Models\Sameleon\User;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {



    // $this->call(AllSeeder::class);
    $this->call(RoleSeeder::class);
    $this->call(PermissionSeeder::class);

    $this->call(CitySeeder::class);

    $this->call(AdminSeeder::class);
    $this->call(ClientSeed::class);

    $this->call(DeliverySeeder::class);

    //\App\Models\Sameleon\Product::factory(5)->create();

    $users = User::factory(10)->create();

    foreach ($users as $user) {
      $this->callWith(ProductSeeder::class, ['user' => $user]);
    }

    $products = Product::all();

    foreach ($products as $product) {
      $this->callWith(StockSeeder::class, ['product' => $product]);
    }

  }
}
