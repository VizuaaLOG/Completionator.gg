<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GamePriority extends Model
{
    use HasFactory;

    const LOW = 1;
    const MEDIUM = 2;
    const HIGH = 3;

    protected $guarded = [];
    protected $table = 'game_priorities';

    public function getForeignKey()
    {
        return 'priority_id';
    }
}
