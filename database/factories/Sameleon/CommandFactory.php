<?php

namespace Database\Factories\Sameleon;

use Illuminate\Database\Eloquent\Factories\Factory;

class CommandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'client_name' => $this->faker->name(),
            'client_phone' => $this->faker->phoneNumber(),
            'client_address' => $this->faker->address(),
        ];
    }
}
