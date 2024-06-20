<?php

namespace App\Services\Impl;

use App\Services\BusinessScaleService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Models\BusinessScale;

class BusinessScaleServiceImpl implements BusinessScaleService
{
    public function findOne(int $id): Model | Builder | null
    {
        return BusinessScale::query()->where('id', $id)->first();
    }

    public function findByName(string $name): Model | Builder | null
    {
        return BusinessScale::query()->where('name', $name)->first();
    }

    public function exists(int $id): bool
    {
        return BusinessScale::query()->where('id' , $id)->exists();
    }

    public function existsByName(string $name): bool
    {
        return BusinessScale::query()->where('name' , $name)->exists();
    }

    public function delete(int $id): bool
    {
        return BusinessScale::query()
            ->where('id', $id)
            ->delete();
    }

    public function update(array $businessScale): bool
    {
        $id = $businessScale[ 'id' ];
        unset($businessScale['id']);

        return BusinessScale::query()
            ->where('id', $id)
            ->update($businessScale);
    }

    public function search(array $filter): Collection
    {
        return BusinessScale::query()
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

    public function save(array $businessScale): Model | Builder
    {
        return BusinessScale::query()->create($businessScale);
    }
}
