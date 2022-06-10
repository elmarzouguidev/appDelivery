<?php

namespace Database\Seeders;

use App\Models\Sameleon\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run($user)
    {
        Product::factory(8)->create(['user_id' => $user->id, 'user_uuid' => $user->uuid]);
    }
}
