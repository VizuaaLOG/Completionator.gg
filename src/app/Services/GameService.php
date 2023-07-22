<?php

namespace App\Services;

use DB;
use App\Models\Game;
use App\Models\GameStatus;
use Illuminate\Support\Arr;
use App\Models\GamePriority;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Exceptions\ErrorUpdatingEntityException;

class GameService
{
    public function paginated(int|null $perPage = null): LengthAwarePaginator
    {
        return Game::paginate($perPage ?? config('pagination.default'));
    }

    public function getCurrentlyPlaying(): EloquentCollection
    {
        return Game::query()
            ->where('status_id', GameStatus::PLAYING)
            ->orderBy('name')
            ->get();
    }

    public function getRecentlyAdded(int $limit = 10): EloquentCollection
    {
        return Game::query()
            ->orderByDesc('created_at')
            ->limit($limit)
            ->get();
    }

    public function getRecentlyCompleted(int $limit = 10): EloquentCollection
    {
        return Game::query()
            ->orderByDesc('completed_at')
            ->where('status_id', GameStatus::COMPLETED)
            ->limit($limit)
            ->get();
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
            $game->publishers()->sync(Arr::get($data, 'publishers'));
            $game->developers()->sync(Arr::get($data, 'developers'));

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
                'purchase_date',
                'release_date',
            ]));

            if(!$updated) {
                throw ErrorUpdatingEntityException::withEntity($game);
            }

            $game->platforms()->sync(Arr::get($data, 'platforms'));
            $game->storefronts()->sync(Arr::get($data, 'storefronts'));
            $game->publishers()->sync(Arr::get($data, 'publishers'));
            $game->developers()->sync(Arr::get($data, 'developers'));

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
