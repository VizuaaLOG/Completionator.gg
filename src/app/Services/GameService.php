<?php

namespace App\Services;

use DB;
use App\Models\Game;
use App\Models\GameStatus;
use Illuminate\Support\Arr;
use App\Models\GamePriority;
use Illuminate\Support\Collection as SupportCollection;
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
        return DB::transaction(function() use($data) {
            $game = Game::create(Arr::only($data, [
                'name',
                'description',
                'status_id',
                'priority_id',
                'purchase_date',
                'release_date',
            ]));

            $game->platforms()->sync(Arr::get($data, 'platforms'));
            $game->storefronts()->sync(Arr::get($data, 'storefronts'));

            if(Arr::has($data, 'cover')) {
                $game->addMedia(Arr::get($data, 'cover'))->toMediaCollection('cover');
            }

            if(Arr::has($data, 'hero')) {
                $game->addMedia(Arr::get($data, 'hero'))->toMediaCollection('hero');
            }

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

            $game->platforms()->sync(Arr::get($data, 'platforms'));
            $game->storefronts()->sync(Arr::get($data, 'storefronts'));

            if(Arr::has($data, 'cover')) {
                $game->addMedia(Arr::get($data, 'cover'))->toMediaCollection('cover');
            }

            if(Arr::has($data, 'hero')) {
                $game->addMedia(Arr::get($data, 'hero'))->toMediaCollection('hero');
            }

            return $game->fresh();
        });
    }

    public function delete(Game $game): bool
    {
        return $game->delete();
    }

    public function statusesForDropdown(): SupportCollection
    {
        return GameStatus::query()
            ->orderBy('name')
            ->get()
            ->map(function(GameStatus $gameStatus) {
                return [
                    'label' => $gameStatus->name,
                    'value' => $gameStatus->id,
                ];
            });
    }

    public function prioritiesForDropdown(): SupportCollection
    {
        return GamePriority::query()
            ->orderBy('name')
            ->get()
            ->map(function(GamePriority $gamePriority) {
                return [
                    'label' => $gamePriority->name,
                    'value' => $gamePriority->id,
                ];
            });
    }
}
