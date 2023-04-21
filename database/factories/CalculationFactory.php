<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CalculationFactory extends Factory
{

    public function definition()
    {
        return [
          'name' => $this->faker->title,
          'formula' => $this->faker->numberBetween(1,6)
        ];
    }
}
