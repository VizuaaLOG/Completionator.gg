<?php

namespace App\Services;

use DB;
use App\Models\Game;
use Illuminate\Support\Arr;
use App\Models\DownloadableContent;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use App\Exceptions\ErrorUpdatingEntityException;

class DownloadableContentService
{
    public function getForGame(Game $game): EloquentCollection
    {
        return DownloadableContent::query()
            ->whereBelongsTo($game)
            ->get();
    }

    public function create(Game $game, array $data): DownloadableContent
    {
        return DB::transaction(function() use($game, $data) {
            /** @var DownloadableContent $dlc */
            $dlc = $game->downloadable_content()->create(Arr::only($data, [
                'name',
                'description',
                'status_id',
                'priority_id',
                'purchase_date',
                'release_date',
            ]));

            $dlc->platforms()->sync(Arr::get($data, 'platforms'));
            $dlc->storefronts()->sync(Arr::get($data, 'storefronts'));
            $dlc->publishers()->sync(Arr::get($data, 'publishers'));
            $dlc->developers()->sync(Arr::get($data, 'developers'));
            $dlc->genres()->sync(Arr::get($data, 'genres'));

            if(Arr::has($data, 'cover')) {
                $dlc->addMedia(Arr::get($data, 'cover'))->toMediaCollection('cover');
            }

            if(Arr::has($data, 'hero')) {
                $dlc->addMedia(Arr::get($data, 'hero'))->toMediaCollection('hero');
            }

            return $dlc;
        });
    }

    public function update(DownloadableContent $dlc, array $data): Game
    {
        return DB::transaction(function() use($dlc, $data) {
            $updated = $dlc->update(Arr::only($data, [
                'name',
                'description',
                'status_id',
                'priority_id',
                'purchase_date',
                'release_date',
            ]));

            if(!$updated) {
                throw ErrorUpdatingEntityException::withEntity($dlc);
            }

            $dlc->platforms()->sync(Arr::get($data, 'platforms'));
            $dlc->storefronts()->sync(Arr::get($data, 'storefronts'));
            $dlc->publishers()->sync(Arr::get($data, 'publishers'));
            $dlc->developers()->sync(Arr::get($data, 'developers'));
            $dlc->genres()->sync(Arr::get($data, 'genres'));

            if(Arr::has($data, 'cover')) {
                $dlc->addMedia(Arr::get($data, 'cover'))->toMediaCollection('cover');
            }

            if(Arr::has($data, 'hero')) {
                $dlc->addMedia(Arr::get($data, 'hero'))->toMediaCollection('hero');
            }

            return $dlc->fresh();
        });
    }

    public function delete(DownloadableContent $downloadableContent): bool
    {
        return $downloadableContent->delete();
    }
}
