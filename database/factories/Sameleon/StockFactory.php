<?php

namespace Database\Factories\Sameleon;

use App\Models\Sameleon\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class StockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'qte_global' => 100,
            'qte_livre' => 0,
            'qte_expidite' => 0,
            'qte_endomage' => 0,
            'qte_rest' => 100,

            'active' => rand(1, 0),
            //'product_id' => rand(1, Product::count())
        ];
    }
}
