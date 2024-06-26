<?php

namespace App\Services\Impl;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Province;
use App\Services\ProvinceService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProvinceServiceImpl implements ProvinceService
{
    public function findOne(int $id): Model | Builder | null
    {
        return Province::query()->where('id', $id)->first();
    }

    public function findByName(string $name): Model | Builder | null
    {
        return Province::query()->where('name', $name)->first();
    }

    public function exists(int $id): bool
    {
        return Province::query()->where('id' , $id)->exists();
    }

    public function existsByName(string $name): bool
    {
        return Province::query()->where('name' , $name)->exists();
    }

    public function delete(int $id): bool
    {
        return Province::query()
            ->where('id', $id)
            ->delete();
    }

    public function update(array $province): bool
    {
        $id = $province[ 'id' ];
        unset($province['id']);

        return Province::query()
            ->where('id', $id)
            ->update($province);
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
        $permissibleSort = ['name'];
        $sort = validateArraySort($filter, $permissibleSort, 'id');

        return Province::query()
            ->when($search, function (Builder $query, array $search) {
                if (isset($search['province_name'])) {
                    $query->whereRaw("name LIKE CONCAT('%', ?, '%')", [$search['province_name']]);
                }
            })
            ->orderByRaw($sort . ' ' . $order);
    }

    public function save(array $province): Model | Builder
    {
        return Province::query()->create($province);
    }
}
