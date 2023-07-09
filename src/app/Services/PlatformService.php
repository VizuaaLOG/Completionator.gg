<?php

namespace App\Services;

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
        return Platform::create(Arr::only($data, [
            'name',
            'description',
        ]));
    }

    /**
     * @throws ErrorUpdatingEntityException
     */
    public function update(Platform $platform, array $data): Platform
    {
        $updated = $platform->update(Arr::only($data, [
            'name',
            'description',
        ]));

        if(!$updated) {
            throw ErrorUpdatingEntityException::withEntity($platform);
        }

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
