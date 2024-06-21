<?php

namespace App\Services\Impl;

use App\Services\SubDistrictService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\SubDistrict;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class SubDistrictServiceImpl implements SubDistrictService
{
    public function findOne(int $id): Model | Builder | null
    {
        return SubDistrict::query()->where('id', $id)->first();
    }

    public function findByName(string $name): Model | Builder | null
    {
        return SubDistrict::query()->where('name', $name)->first();
    }

    public function exists(int $id): bool
    {
        return SubDistrict::query()->where('id' , $id)->exists();
    }

    public function existsByName(string $name): bool
    {
        return SubDistrict::query()->where('name' , $name)->exists();
    }

    public function delete(int $id): bool
    {
        return SubDistrict::query()
            ->where('id', $id)
            ->delete();
    }

    public function update(array $subDistrict): bool
    {
        $id = $subDistrict[ 'id' ];
        unset($subDistrict['id']);

        return SubDistrict::query()
            ->where('id', $id)
            ->update($subDistrict);
    }

    public function search(array $filter): LengthAwarePaginator
    {
        $permissibleSort = [
            'sub_district_id' => 'sub_districts.id',
            'sub_district_name' => 'sub_districts.name',
            'district_name' => 'districts.name'
        ];

        $search = $filter['search'];
        $sort = isset($filter[ 'sort' ]) && in_array($filter[ 'sort' ], array_keys($permissibleSort)) ? : 'districts.id';
        p_info("filter: " . json_encode($filter) . ", sort: $sort");

        return SubDistrict::query()
            ->select([
                'sub_districts.id AS sub_district_id',
                'sub_districts.name AS sub_district_name',
                'districts.name AS district_name',
            ])
            ->join('districts', 'districts.id', '=', 'sub_districts.district_id')
            ->when($search, function (Builder $query, array $search) {
                if (isset($search['sub_district_name'])) {
                    $query->whereRaw("sub_districts.name LIKE CONCAT('%', ?, '%')", [$search['sub_district_name']]);
                }

                if (isset($search['district_id'])) {
                    $query->whereRaw("districts.id = ?", [$search['district_id']]);
                }
            })
            ->orderByRaw($sort . ' ' . $filter['order'])
            ->paginate(perPage: $filter['limit'], page: $filter['offset']);
    }

    public function save(array $subDistrict): Model | Builder
    {
        return SubDistrict::query()->create($subDistrict);
    }
}
