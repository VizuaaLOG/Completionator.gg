<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameStatus extends Model
{
    use HasFactory;

    const BACKLOG = 1;
    const PLAYING = 2;
    const COMPLETED = 3;
    const WONT_PLAY = 4;
    const RETIRED = 5;

    protected $guarded = [];
    protected $table = 'game_statuses';

    public function getForeignKey()
    {
        return 'status_id';
    }
}
