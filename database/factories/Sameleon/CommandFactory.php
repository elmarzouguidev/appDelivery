<?php

namespace Database\Factories\Sameleon;

use App\Models\Sameleon\Command;
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

    public function configure()
    {
        return $this->afterCreating(function (Command $command) {
            $command->items()->saveMany(ItemFactory::new()->times(rand(1, 2))->make(['command_id' => $command->id,'command_uuid' => $command->uuid]));
        });
    }
}
