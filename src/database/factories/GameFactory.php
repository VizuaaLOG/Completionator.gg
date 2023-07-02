<?php

namespace Database\Factories;

use App\Models\Game;
use App\Models\GameStatus;
use App\Models\GamePriority;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class GameFactory extends Factory
{
    protected $model = Game::class;

    public function definition(): array
    {
        return [
            'name'             => $this->faker->name(),
            'description'      => $this->faker->text(),
            'game_status_id'   => function(array $attributes) {
                return GameStatus::inRandomOrder()->first();
            },
            'game_priority_id'   => function(array $attributes) {
                return GamePriority::inRandomOrder()->first();
            },
            'created_at'       => Carbon::now(),
            'updated_at'       => Carbon::now(),
        ];
    }
}
