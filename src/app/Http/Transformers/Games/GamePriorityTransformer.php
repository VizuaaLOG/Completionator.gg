<?php

namespace App\Http\Transformers\Games;

use App\Models\GamePriority;
use League\Fractal\TransformerAbstract;

class GamePriorityTransformer extends TransformerAbstract
{
    public function transform(GamePriority $priority): array
    {
        return [
            'id'       => $priority->id,
            'name'     => $priority->name,
            'links'    => [
                'show'    => route('game_priorities.show', ['game_priority' => $priority]),
            ],
        ];
    }
}
