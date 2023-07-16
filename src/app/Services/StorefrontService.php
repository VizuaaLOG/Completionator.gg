<?php

namespace App\Services;

use DB;
use App\Models\Storefront;
use Illuminate\Support\Arr;
use App\Exceptions\EntityInUseException;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection as SupportCollection;
use App\Exceptions\ErrorUpdatingEntityException;

class StorefrontService
{
    public function all(array $counts = []): EloquentCollection
    {
        return Storefront::query()
            ->withCount($counts)
            ->get();
    }

    public function allForDropdown(): SupportCollection
    {
        return Storefront::query()
            ->orderBy('name')
            ->get()
            ->map(function(Storefront $storefront) {
                return [
                    'label' => $storefront->name,
                    'value' => $storefront->id,
                ];
            });
    }

    public function create(array $data): Storefront
    {
        return DB::transaction(function() use($data) {
            $storefront = Storefront::create(Arr::only($data, [
                'name',
            ]));

            if(Arr::has($data, 'icon')) {
                $storefront->addMedia(Arr::get($data, 'icon'))->toMediaCollection('icon');
            }

            return $storefront;
        });
    }

    public function update(Storefront $storefront, array $data): Storefront
    {
        DB::transaction(function() use($storefront, $data) {
            $updated = $storefront->update(Arr::only($data, [
                'name',
            ]));

            if(!$updated) {
                throw ErrorUpdatingEntityException::withEntity($storefront);
            }

            if(Arr::has($data, 'icon')) {
                $storefront->addMedia(Arr::get($data, 'icon'))->toMediaCollection('icon');
            }
        });

        return $storefront->fresh();
    }

    /**
     * @throws EntityInUseException
     */
    public function delete(Storefront $storefront): bool
    {
        if($storefront->games()->exists()) {
            throw EntityInUseException::withEntity($storefront);
        }

        return $storefront->delete();
    }
}
