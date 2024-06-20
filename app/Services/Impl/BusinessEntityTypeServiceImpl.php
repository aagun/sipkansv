<?php

namespace App\Services\Impl;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Services\BusinessEntityTypeService;
use App\Models\BusinessEntityType;

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

    public function search(array $filter): Collection
    {
        return BusinessEntityType::query()
            ->when($filter, function (Builder $query, array $filter) {
                if (isset($filter['name'])) {
                    $query->whereRaw("name LIKE CONCAT('%', ?, '%')", [$filter['name']]);
                }

                if (isset($filter['description'])) {
                    $query->whereRaw("description LIKE CONCAT('%', ?, '%')", [$filter['description']]);
                }
            })
            ->orderByRaw("id asc")
            ->get();
    }

    public function save(array $businessEntityType): Model | Builder
    {
        return BusinessEntityType::query()->create($businessEntityType);
    }
}
