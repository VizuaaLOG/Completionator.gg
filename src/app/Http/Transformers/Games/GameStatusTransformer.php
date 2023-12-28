<?php

namespace App\Http\Transformers\Games;

use App\Models\GameStatus;
use League\Fractal\TransformerAbstract;

class GameStatusTransformer extends TransformerAbstract
{
    public function transform(GameStatus $status): array
    {
        return [
            'id'       => $status->id,
            'name'     => $status->name,
            'links'    => [
                'show'    => route('game_statuses.show', ['game_status' => $status]),
            ],
        ];
    }
}
