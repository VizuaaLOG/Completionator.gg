<?php

namespace App\Services;

use DB;
use App\Models\Company;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Exceptions\ErrorUpdatingEntityException;

class CompanyService
{
    public function paginated(int|null $perPage = null): LengthAwarePaginator
    {
        return Company::paginate($perPage ?? config('pagination.default'));
    }

    public function getForDropdown(): SupportCollection
    {
        return Company::query()
            ->orderBy('name')
            ->get()
            ->map(function(Company $company) {
                return [
                    'label' => $company->name,
                    'value' => $company->id,
                ];
            });
    }

    public function create(array $data): Company
    {
        return DB::transaction(function() use($data) {
            $company = Company::create(Arr::only($data, [
                'name',
                'description',
                'established_date',
            ]));

            if(Arr::has($data, 'logo')) {
                $company->addMedia(Arr::get($data, 'logo'))->toMediaCollection('logo');
            }

            return $company;
        });
    }

    public function update(Company $company, array $data): Company
    {
        return DB::transaction(function() use($company, $data) {
            $updated = $company->update(Arr::only($data, [
                'name',
                'description',
                'established_date',
            ]));

            if(!$updated) {
                throw ErrorUpdatingEntityException::withEntity($company);
            }

            if(Arr::has($data, 'logo')) {
                $company->addMedia(Arr::get($data, 'logo'))->toMediaCollection('logo');
            }

            return $company->fresh();
        });
    }

    public function delete(Company $company): bool
    {
        return $company->delete();
    }
}
