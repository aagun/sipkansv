<?php

namespace App\Services\Impl;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Observation;
use App\Services\ObservationService;
use Illuminate\Pagination\LengthAwarePaginator;

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

    public function search(array $filter): LengthAwarePaginator
    {
        $search = $filter['search'];
        $order = $filter['order'];
        $permissibleSort = ['name', 'description'];
        $sort = validateArraySort($filter, $permissibleSort, 'id');

        return Observation::query()
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

    public function save(array $observation): Model | Builder
    {
        return Observation::query()->create($observation);
    }
}
