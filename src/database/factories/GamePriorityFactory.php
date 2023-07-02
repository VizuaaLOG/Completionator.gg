<?php

namespace Database\Factories;

use App\Models\GamePriority;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class GamePriorityFactory extends Factory
{
    protected $model = GamePriority::class;

    public function definition(): array
    {
        return [
            'name'       => $this->faker->name(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
