<?php

namespace App\Services;

use DB;
use App\Models\User;
use App\Models\Storefront;
use Illuminate\Support\Arr;
use App\Exceptions\EntityInUseException;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection as SupportCollection;
use App\Exceptions\ErrorUpdatingEntityException;

class StorefrontService
{
    public function all(User $user, array $counts = []): EloquentCollection
    {
        return Storefront::query()
            ->whereBelongsTo($user, 'user')
            ->withCount($counts)
            ->get();
    }

    public function allForDropdown(User $user): SupportCollection
    {
        return Storefront::query()
            ->whereBelongsTo($user, 'user')
            ->orderBy('name')
            ->get()
            ->map(function(Storefront $storefront) {
                return [
                    'label' => $storefront->name,
                    'value' => $storefront->id,
                ];
            });
    }

    public function create(User $user, array $data): Storefront
    {
        return DB::transaction(function() use($user, $data) {
            $storefront = Storefront::make(Arr::only($data, [
                'name',
            ]));

            $storefront->user()->associate($user);
            $storefront->save();

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
