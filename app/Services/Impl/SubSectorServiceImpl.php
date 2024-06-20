<?php

namespace App\Services\Impl;

use App\Services\SubSectorService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Models\SubSector;

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

    public function search(array $filter): Collection
    {
        return SubSector::query()
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

    public function save(array $subSector): Model | Builder
    {
        return SubSector::query()->create($subSector);
    }
}
