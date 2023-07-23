<?php

namespace Database\Factories;

use App\Models\Game;
use App\Models\GameStatus;
use App\Models\GamePriority;
use Illuminate\Support\Carbon;
use App\Models\DownloadableContent;
use Illuminate\Database\Eloquent\Factories\Factory;

class DownloadableContentFactory extends Factory
{
    protected $model = DownloadableContent::class;

    public function definition(): array
    {
        return [
            'name'           => $this->faker->name(),
            'description'    => $this->faker->text(),
            'release_date'   => Carbon::now(),
            'purchased_date' => Carbon::now(),
            'completed_at'   => Carbon::now(),
            'created_at'     => Carbon::now(),
            'updated_at'     => Carbon::now(),

            'game_id'     => Game::factory(),
            'status_id'   => GameStatus::factory(),
            'priority_id' => GamePriority::factory(),
        ];
    }
}
