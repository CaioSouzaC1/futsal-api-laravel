<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Game;
use App\Models\Player;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        Team::factory(10)->create();
        Game::factory(10)->create();
        Player::factory(20)->create();

        User::factory()->create([
            'name' => 'Caio César de Souza',
            'email' => 'caiosouza@gmail.com',
            'password' => Hash::make('123456'),
            'remember_token' => null,
            'email_verified_at' => null
        ]);
    }
}
