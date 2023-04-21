<?php

namespace Database\Factories;

use Azuriom\Models\Player;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Player>
 */
class PlayerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => UserFactory::new(),
            'faction_id' => FactionFactory::new(),
            'kills' => $this->faker->numberBetween(1,100),
            'deaths' => $this->faker->numberBetween(1,100),
        ];
    }
}
