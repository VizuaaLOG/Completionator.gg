<?php

namespace App\Services;

use App\Models\GamePriority;
use Illuminate\Database\Eloquent\Collection;

class GamePriorityService
{
    public function all(): Collection
    {
        return GamePriority::all();
    }
}
