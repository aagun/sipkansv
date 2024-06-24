<?php

namespace App\Services\Impl;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Services\BusinessEntityTypeService;
use App\Models\BusinessEntityType;
use Illuminate\Pagination\LengthAwarePaginator;

class BusinessEntityTypeServiceImpl implements BusinessEntityTypeService
{
    public function findOne(int $id): Model | Builder | null
    {
        return BusinessEntityType::query()->where('id', $id)->first();
    }

    public function findByName(string $name): Model | Builder | null
    {
        return BusinessEntityType::query()->where('name', $name)->first();
    }

    public function exists(int $id): bool
    {
        return BusinessEntityType::query()->where('id' , $id)->exists();
    }

    public function existsByName(string $name): bool
    {
        return BusinessEntityType::query()->where('name' , $name)->exists();
    }

    public function delete(int $id): bool
    {
        return BusinessEntityType::query()
            ->where('id', $id)
            ->delete();
    }

    public function update(array $businessEntityType): bool
    {
        $id = $businessEntityType[ 'id' ];
        unset($businessEntityType['id']);

        return BusinessEntityType::query()
            ->where('id', $id)
            ->update($businessEntityType);
    }

    public function search(array $filter): LengthAwarePaginator
    {
        $search = $filter['search'];
        $order = $filter['order'];
        $permissibleSort = ['name', 'description'];
        $sort = validateArraySort($filter, $permissibleSort, 'id');

        return BusinessEntityType::query()
            ->when($search, function (Builder $query, array $search) {
                if (isset($search['name'])) {
                    $query->whereRaw("name LIKE CONCAT('%', ?, '%')", [$search['name']]);
                }

                if (isset($search['description'])) {
                    $query->whereRaw("description LIKE CONCAT('%', ?, '%')", [$search['description']]);
                }
            })
            ->orderByRaw("$sort $order")
            ->paginate(perPage: $filter['limit'], page: $filter['offset']);
    }

    public function save(array $businessEntityType): Model | Builder
    {
        return BusinessEntityType::query()->create($businessEntityType);
    }
}
