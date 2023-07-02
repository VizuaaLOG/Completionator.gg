<?php

namespace App\Services;

use App\Models\GameStatus;
use Illuminate\Database\Eloquent\Collection;

class GameStatusService
{
    public function all(): Collection
    {
        return GameStatus::all();
    }
}
