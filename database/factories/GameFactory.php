<?php

namespace Database\Factories;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faker = \Faker\Factory::create();
        $homeTeamId = Team::inRandomOrder()->value('id');
        $visitorTeamId = Team::where('id', '!=', $homeTeamId)->inRandomOrder()->value('id');

        return [
            'date' =>  $faker->dateTimeThisYear(),
            'home_team_id' => $homeTeamId,
            'visitor_team_id' => $visitorTeamId,
            'home_team_goals' => rand(0, 5),
            'visitor_team_goals' => rand(0, 5),
        ];
    }
}
