<?php

namespace App\Services\Impl;

use App\Services\SubSectorService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\SubSector;
use Illuminate\Pagination\LengthAwarePaginator;

class SubSectorServiceImpl implements SubSectorService
{
    public function findOne(int $id): Model | Builder | null
    {
        return SubSector::query()->where('id', $id)->first();
    }

    public function findByName(string $name): Model | Builder | null
    {
        return SubSector::query()->where('name', $name)->first();
    }

    public function exists(int $id): bool
    {
        return SubSector::query()->where('id' , $id)->exists();
    }

    public function existsByName(string $name): bool
    {
        return SubSector::query()->where('name' , $name)->exists();
    }

    public function delete(int $id): bool
    {
        return SubSector::query()
            ->where('id', $id)
            ->delete();
    }

    public function update(array $subSector): bool
    {
        $id = $subSector[ 'id' ];
        unset($subSector['id']);

        return SubSector::query()
            ->where('id', $id)
            ->update($subSector);
    }

    public function search(array $filter): LengthAwarePaginator
    {
        $search = $filter['search'];
        $order = $filter['order'];
        $permissibleSort = ['name', 'description'];
        $sort = validateArraySort($filter, $permissibleSort, 'id');

        return SubSector::query()
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

    public function save(array $subSector): Model | Builder
    {
        return SubSector::query()->create($subSector);
    }
}
