<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{

    public function definition() : array
    {
        return [
            'code' => $this->faker->randomNumber(),
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'price' => $this->faker->randomNumber(),
            'quantity' => $this->faker->numberBetween('1','30'),
            'state' => $this->faker->randomElement([true, false])
        ];
    }
}
