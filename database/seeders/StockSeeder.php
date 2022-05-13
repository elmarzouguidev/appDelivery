<?php

namespace Database\Seeders;

use App\Models\Sameleon\Stock;
use Illuminate\Database\Seeder;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run($product)
    {
        Stock::factory(50)->create(['product_id' => $product->id, 'product_uuid' => $product->uuid]);
    }
}
