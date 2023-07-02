<?php

namespace Database\Seeders;

use App\Models\GamePriority;
use Illuminate\Database\Seeder;

class GamePrioritiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GamePriority::create([
            'id' => 1,
            'name' => 'Low',
        ]);

        GamePriority::create([
            'id' => 2,
            'name' => 'Medium',
        ]);

        GamePriority::create([
            'id' => 3,
            'name' => 'High',
        ]);
    }
}
