<?php

namespace Database\Seeders;

use App\Models\GameStatus;
use Illuminate\Database\Seeder;

class GameStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GameStatus::create([
            'id' => 1,
            'name' => 'Backlog',
        ]);

        GameStatus::create([
            'id' => 2,
            'name' => 'Playing',
        ]);

        GameStatus::create([
            'id' => 3,
            'name' => 'Completed',
        ]);

        GameStatus::create([
            'id' => 4,
            'name' => 'Won\'t Play',
        ]);

        GameStatus::create([
            'id' => 5,
            'name' => 'Retired',
        ]);
    }
}
