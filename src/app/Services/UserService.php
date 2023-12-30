<?php

namespace App\Services;

use DB;
use Arr;
use Hash;
use Throwable;
use App\Models\User;
use App\Exceptions\ErrorUpdatingEntityException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserService
{
    public function paginated(int|null $perPage = null): LengthAwarePaginator
    {
        return User::paginate($perPage ?? config('pagination.default'));
    }

    public function create(array $data, int $role): User
    {
        return User::create([
            'name'         => Arr::get($data, 'name'),
            'email'        => Arr::get($data, 'email'),
            'password'     => Hash::make(Arr::get($data, 'password')),
            'role_id' => $role,
        ]);
    }

    /**
     * @throws Throwable
     */
    public function update(User $user, array $data, int|null $role = null): User
    {
        return DB::transaction(function () use ($user, $data, $role) {
            if (Arr::has($data, 'password')) {
                Arr::set($data, 'password', Hash::make(Arr::get($data, 'password')));
            }

            $updated = $user->update(Arr::only($data, [
                'name',
                'email',
                'password',
            ]));

            if (!$updated) {
                throw ErrorUpdatingEntityException::withEntity($user);
            }

            if (!is_null($role)) {
                $user->role()->associate($role);
                $user->save();
            }

            return $user->fresh();
        });
    }

    public function delete(User $user): bool
    {
        return $user->delete();
    }
}
