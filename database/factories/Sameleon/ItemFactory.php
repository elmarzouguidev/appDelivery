<?php

namespace Database\Factories\Sameleon;

use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'quantity' => $qte = 2,
            'prix_uni' => $priceUni = $this->faker->numberBetween(100, 900),
            'prix_total' => $qte * $priceUni,
            'designation' => $this->faker->word,
            'product' => $this->faker->word,
        ];
    }
}
