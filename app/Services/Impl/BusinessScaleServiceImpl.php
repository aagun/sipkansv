<?php

namespace App\Services\Impl;

use App\Services\BusinessScaleService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\BusinessScale;
use Illuminate\Pagination\LengthAwarePaginator;

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

    public function search(array $filter): LengthAwarePaginator
    {
        if ($filter['limit'] == 0) $filter['limit'] = $this->searchMainQuery($filter)->count();
        return $this->searchMainQuery($filter)
            ->paginate(perPage: $filter['limit'], page: $filter['offset']);
    }

    private function searchMainQuery(array $filter)
    {
        $search = $filter['search'];
        $order = $filter['order'];
        $permissibleSort = ['name', 'description'];
        $sort = validateArraySort($filter, $permissibleSort, 'id');

        return BusinessScale::query()
            ->when($search, function (Builder $query, array $search) {
                if (isset($search['name'])) {
                    $query->whereRaw("name LIKE CONCAT('%', ?, '%')", [$search['name']]);
                }

                if (isset($search['description'])) {
                    $query->whereRaw("description LIKE CONCAT('%', ?, '%')", [$search['description']]);
                }
            })
            ->orderByRaw("$sort $order");
    }
    public function save(array $businessScale): Model | Builder
    {
        return BusinessScale::query()->create($businessScale);
    }
}
