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
     
        $name = $this->faker->sentence(20);

        return [
            'name' => $this->faker->word,
            'description' => $this->faker->text(),
       
            'qte_global' => rand(1, 60),
            'qte_livre' => rand(1, 10),
            'qte_expidite' => rand(1, 20),
            'qte_endomage' => rand(1, 10),
            'qte_rest' => rand(1, 30),

            'price' => $this->faker->numberBetween(100, 500),
            'sku' => $this->faker->unique()->regexify('[A-Z0-9]{10}'),
            'active' => rand(1, 0),

            'user_id' => 2
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Product $item) {
            $url = 'https://source.unsplash.com/random/900x900';
            $item
                ->addMediaFromUrl($url)
                ->toMediaCollection('products_images');
        });
    }
}
