<?php

namespace App\Services;

use App\Models\Genre;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Exceptions\ErrorUpdatingEntityException;

class GenreService
{
    public function paginated(int|null $perPage = null): LengthAwarePaginator
    {
        return Genre::paginate($perPage ?? config('pagination.default'));
    }

    public function getForDropdown(): SupportCollection
    {
        return Genre::query()
            ->orderBy('name')
            ->get()
            ->map(function(Genre $genre) {
                return [
                    'label' => $genre->name,
                    'value' => $genre->id,
                ];
            });
    }

    public function create(array $data): Genre
    {
        return Genre::create(Arr::only($data, [
            'name',
        ]));
    }

    /**
     * @throws ErrorUpdatingEntityException
     */
    public function update(Genre $genre, array $data): Genre
    {
        $updated = $genre->update(Arr::only($data, [
            'name',
        ]));

        if(!$updated) {
            throw ErrorUpdatingEntityException::withEntity($genre);
        }

        return $genre->fresh();
    }

    public function delete(Genre $genre): bool
    {
        return $genre->delete();
    }
}
