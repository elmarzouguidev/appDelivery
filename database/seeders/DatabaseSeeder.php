<?php

namespace Database\Seeders;

use App\Models\Sameleon\Product;
use App\Models\Sameleon\User;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {

    Storage::disk('public')->deleteDirectory('app-files');

    $this->clearAll();

    // $this->call(AllSeeder::class);
    $this->call(RoleSeeder::class);
    $this->call(PermissionSeeder::class);

    $this->call(CitySeeder::class);

    $this->call(AdminSeeder::class);
    $this->call(ClientSeed::class);

    $this->call(DeliverySeeder::class);

    //\App\Models\Sameleon\Product::factory(5)->create();

    $users = User::role('Client')->get();

    foreach ($users as $user) {

      $this->callWith(ProductSeeder::class, ['user' => $user]);

      /****Create Commands ForEach Clients ****/

      // $this->callWith(CommandSeeder::class, ['user' => $user]);
    }
  }

  private function clearAll()
  {
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('cache:clear');
  }
}
