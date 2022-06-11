<?php

namespace Database\Factories\Sameleon;

use App\Models\Sameleon\Product;
use App\Models\Sameleon\User;
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

            'qte_global' => $qte = 10,
            'qte_livre' => 0,
            'qte_expidite' => 0,
            'qte_endomage' => 0,
            'qte_rest' => rand(0, $qte),

            'price' => $this->faker->numberBetween(100, 300),
            'sku' => $this->faker->unique()->regexify('[A-Z0-9]{10}'),
            'active' => rand(1, 0),

            //'user_id' =>  rand(1, User::count())
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Product $item) {
            $url = 'https://source.unsplash.com/random/400x400';

            $item
                ->addMediaFromUrl($url)
                ->toMediaCollection('products_photos');

            $item->increaseStock($item->qte_global);
        });
    }
}
