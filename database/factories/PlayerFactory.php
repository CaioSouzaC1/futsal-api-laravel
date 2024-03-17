<?php

namespace Database\Factories;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Player>
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

        $teamId = Team::inRandomOrder()->value('id');

        return [
            'name' => fake()->name(),
            'tshirt' => rand(1, 99),
            'team_id' => $teamId
        ];
    }
}
