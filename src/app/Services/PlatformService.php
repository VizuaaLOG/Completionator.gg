<?php

namespace App\Services;

use DB;
use App\Models\Platform;
use Illuminate\Support\Arr;
use App\Exceptions\EntityInUseException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Exceptions\ErrorUpdatingEntityException;

class PlatformService
{
    public function all(): Collection
    {
        return Platform::all();
    }

    public function create(array $data): Platform
    {
        return DB::transaction(function() use($data) {
            $platform = Platform::create(Arr::only($data, [
                'name',
                'description',
                'manufacturer',
                'purchase_date',
                'release_date',
            ]));

            if(Arr::has($data, 'cover')) {
                $platform->addMedia(Arr::get($data, 'cover'))->toMediaCollection('cover');
            }

            if(Arr::has($data, 'hero')) {
                $platform->addMedia(Arr::get($data, 'hero'))->toMediaCollection('hero');
            }
        });
    }

    public function update(Platform $platform, array $data): Platform
    {
        DB::transaction(function() use($platform, $data) {
            $updated = $platform->update(Arr::only($data, [
                'name',
                'description',
                'manufacturer',
                'purchase_date',
                'release_date',
            ]));

            if(!$updated) {
                throw ErrorUpdatingEntityException::withEntity($platform);
            }

            if(Arr::has($data, 'cover')) {
                $platform->clearMediaCollection('cover');
                $platform->addMedia(Arr::get($data, 'cover'))->toMediaCollection('cover');
            }

            if(Arr::has($data, 'hero')) {
                $platform->clearMediaCollection('hero');
                $platform->addMedia(Arr::get($data, 'hero'))->toMediaCollection('hero');
            }
        });

        return $platform->fresh();
    }

    /**
     * @throws EntityInUseException
     */
    public function delete(Platform $platform): bool
    {
        if($platform->games()->exists()) {
            throw EntityInUseException::withEntity($platform);
        }

        return $platform->delete();
    }
}
