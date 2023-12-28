<?php

namespace App\Http\Transformers\Games;

use App\Models\Game;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection;
use App\Http\Transformers\Platforms\PlatformTransformer;

class GameTransformer extends TransformerAbstract
{
    protected array $availableIncludes = [
        'status',
        'priority',
        'platforms',
    ];

    public function transform(Game $game): array
    {
        return [
            'id'       => $game->id,
            'name'     => $game->name,
            'description' => $game->description,
            'status_id' => $game->status_id,
            'priority_id' => $game->priority_id,
            'links'    => [
                'show'    => route('games.show', ['game' => $game]),
                'update'  => route('games.update', ['game' => $game]),
                'destroy' => route('games.destroy', ['game' => $game]),
            ],
        ];
    }

    public function includeStatus(Game $game): Item
    {
        return $this->item($game->status, new GameStatusTransformer);
    }

    public function includePriority(Game $game): Item
    {
        return $this->item($game->priority, new GamePriorityTransformer);
    }

    public function includePlatforms(Game $game): Collection
    {
        return $this->collection($game->platforms, new PlatformTransformer);
    }
}
