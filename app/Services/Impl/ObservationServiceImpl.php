<?php

namespace App\Services\Impl;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Observation;
use App\Services\ObservationService;

class ObservationServiceImpl implements ObservationService
{
    public function findOne(int $id): Model | Builder | null
    {
        return Observation::query()->where('id', $id)->first();
    }

    public function findByName(string $name): Model | Builder | null
    {
        return Observation::query()->where('name', $name)->first();
    }

    public function exists(int $id): bool
    {
        return Observation::query()->where('id' , $id)->exists();
    }

    public function existsByName(string $name): bool
    {
        return Observation::query()->where('name' , $name)->exists();
    }

    public function delete(int $id): bool
    {
        return Observation::query()
            ->where('id', $id)
            ->delete();
    }

    public function update(array $observation): bool
    {
        $id = $observation[ 'id' ];
        unset($observation['id']);

        return Observation::query()
            ->where('id', $id)
            ->update($observation);
    }

    public function search(array $filter): Collection
    {
        return Observation::query()
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

    public function save(array $observation): Model | Builder
    {
        return Observation::query()->create($observation);
    }
}
