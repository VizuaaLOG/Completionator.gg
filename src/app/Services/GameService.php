<?php

namespace App\Services;

use DB;
use App\Models\Game;
use App\Models\Platform;
use App\Models\GameStatus;
use Illuminate\Support\Arr;
use App\Models\GamePriority;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Exceptions\ErrorUpdatingEntityException;

class GameService
{
    public function paginated(int|null $perPage = null): LengthAwarePaginator
    {
        return Game::paginate($perPage ?? config('pagination.default'));
    }

    public function create(array $data): Game
    {
        // Set default
        if(empty(Arr::get($data, 'status_id'))) {
            $data['status_id'] = GameStatus::BACKLOG;
        }

        if(empty(Arr::get($data, 'priority_id'))) {
            $data['priority_id'] = GamePriority::LOW;
        }

        return DB::transaction(function() use($data) {
            $game = Game::create(Arr::only($data, [
                'name',
                'description',
                'status_id',
                'priority_id',
            ]));

            // Attach to platforms
            $game->platforms()->sync(Arr::get($data, 'platform_ids'));

            return $game;
        });
    }

    public function update(Game $game, array $data): Game
    {
        return DB::transaction(function() use($game, $data) {
            $updated = $game->update(Arr::only($data, [
                'name',
                'description',
                'status_id',
                'priority_id',
            ]));

            if(!$updated) {
                throw ErrorUpdatingEntityException::withEntity($game);
            }

            if(Arr::has($data, 'platform_ids')) {
                // Attach to platforms
                $game->platforms()->sync(Arr::get($data, 'platform_ids'));
            }

            return $game->fresh();
        });
    }

    public function delete(Game $game): bool
    {
        return $game->delete();
    }

    public function attachToPlatforms(Game $game, array $platformIds): bool
    {
        $game->platforms()->syncWithoutDetaching($platformIds);
        return true;
    }

    public function detachFromPlatforms(Game $game, array $platformIds): bool
    {
        $game->platforms()->detach($platformIds);
        return true;
    }
}
