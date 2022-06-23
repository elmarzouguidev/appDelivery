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


    $this->clearAll();

    $this->call(RoleSeeder::class);

    $this->call(PermissionSeeder::class);

    $this->call(CitySeeder::class);

    $this->call(AdminSeeder::class);

    Artisan::call('config:clear');
    
    Artisan::call('cache:clear');

    $this->call(ClientSeed::class);

    $this->call(DeliverySeeder::class);

    $this->call(BankSeeder::class);

    $this->call(IntegrationSeeder::class);

    $users = User::role('Client')->get();

    foreach ($users as $user) {

      $this->callWith(ProductSeeder::class, ['user' => $user]);

      // $this->callWith(CommandSeeder::class, ['user' => $user]);
    }

   
  }

  private function clearAll()
  {

    Storage::disk('public')->deleteDirectory('app-files');

    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('cache:clear');
  }
}
