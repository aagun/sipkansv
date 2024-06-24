<?php

namespace App\Services\Impl;

use App\Services\VillageService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Models\Village;

class VillageServiceImpl implements VillageService
{
    public function findOne(int $id): Model | Builder | null
    {
        return Village::query()->where('id', $id)->first();
    }

    public function findByName(string $name): Model | Builder | null
    {
        return Village::query()->where('name', $name)->first();
    }

    public function exists(int $id): bool
    {
        return Village::query()->where('id' , $id)->exists();
    }

    public function existsByName(string $name): bool
    {
        return Village::query()->where('name' , $name)->exists();
    }

    public function delete(int $id): bool
    {
        return Village::query()
            ->where('id', $id)
            ->delete();
    }

    public function update(array $village): bool
    {
        $id = $village[ 'id' ];
        unset($village['id']);

        return Village::query()
            ->where('id', $id)
            ->update($village);
    }

    public function search(array $filter): LengthAwarePaginator
    {
        $permissibleSort = [
            'village_id' => 'villages.id',
            'village_name' => 'villages.name',
            'sub_district_name' => 'sub_districts.name'
        ];

        $search = $filter['search'];
        $order = $filter['order'];
        $sort = validateObjectSort($filter, $permissibleSort, 'villages.id');

        return Village::query()
            ->select([
                'villages.id AS village_id',
                'villages.name AS village_name',
                'sub_districts.name AS sub_district_name',
            ])
            ->join('sub_districts', 'sub_districts.id', '=', 'villages.sub_district_id')
            ->when($search, function (Builder $query, array $search) {
                if (isset($search['village_name'])) {
                    $query->whereRaw("sub_districts.name LIKE CONCAT('%', ?, '%')", [$search['village_name']]);
                }

                if (isset($search['sub_district_id'])) {
                    $query->whereRaw("sub_districts.id = ?", [$search['sub_district_id']]);
                }
            })
            ->orderByRaw("$sort $order")
            ->paginate(perPage: $filter['limit'], page: $filter['offset']);
    }

    public function save(array $village): Model | Builder
    {
        return Village::query()->create($village);
    }
}
