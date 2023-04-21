<?php

namespace Database\Factories;

use Azuriom\Plugin\RankFaction\Models\Faction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Faction>
 */
class FactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'totem' => $this->faker->numberBetween(0,100),
            'koth' => $this->faker->numberBetween(0,100),
        ];
    }
}
