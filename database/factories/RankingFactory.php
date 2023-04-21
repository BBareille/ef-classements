<?php

namespace Database\Factories;

use Azuriom\Models\Calculation;
use Illuminate\Database\Eloquent\Factories\Factory;

class RankingFactory extends Factory
{

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'calculation_id' => CalculationFactory::new(),
        ];
    }
}
