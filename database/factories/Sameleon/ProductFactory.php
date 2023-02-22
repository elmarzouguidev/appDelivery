<?php

namespace Database\Factories\Sameleon;

use App\Models\Sameleon\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->text(),
            'qte_global' => 0,
            'qte_livre' => 0,
            'qte_expidite' => 0,
            'qte_endomage' => 0,
            'qte_rest' => 0,

            'price' => $this->faker->numberBetween(100, 300),
            //'sku' => $this->faker->unique()->regexify('[A-Z0-9]{10}'),
            'active' => rand(1, 0),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Product $item) {
            if (connection_status() === CONNECTION_NORMAL) {
                $url = 'https://loremflickr.com/320/240';
                //$url = $this->faker->imageUrl(800, 600);

                $item
                    ->addMediaFromUrl($url)
                    ->toMediaCollection('products_photos');
            }
        });
    }
}
