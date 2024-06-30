<?php

namespace App\Services\Impl;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Services\DistrictService;
use App\Models\District;

class DistrictServiceImpl  implements DistrictService
{
    public function findOne(int $id): Model | Builder | null
    {
        return District::query()->where('id', $id)->first();
    }

    public function findByName(string $name): Model | Builder | null
    {
        return District::query()->where('name', $name)->first();
    }

    public function exists(int $id): bool
    {
        return District::query()->where('id' , $id)->exists();
    }

    public function existsByName(string $name): bool
    {
        return District::query()->where('name' , $name)->exists();
    }

    public function delete(int $id): bool
    {
        return District::query()
            ->where('id', $id)
            ->delete();
    }

    public function update(array $district): bool
    {
        $id = $district[ 'id' ];
        unset($district['id']);

        return District::query()
            ->where('id', $id)
            ->update($district);
    }

    public function search(array $filter): LengthAwarePaginator
    {
        if ($filter['limit'] == 0) $filter['limit'] = $this->searchMainQuery($filter)->count();
        return $this->searchMainQuery($filter)
            ->paginate(
                perPage: $filter['limit'],
                page: $filter['offset']
            );
    }

    private function searchMainQuery(array $filter)
    {
        $permissibleSort = [
            'district_id' => 'districts.id',
            'district_name' => 'districts.name',
            'province_name' => 'provinces.name'
        ];
        $search = $filter['search'];
        $order = $filter['order'];
        $sort = validateObjectSort($filter, $permissibleSort, 'districts.id');

        return District::query()
            ->select([
                'districts.id AS district_id',
                'districts.name AS district_name',
                'provinces.name AS province_name',
            ])
            ->join('provinces', 'provinces.id', '=', 'districts.province_id')
            ->when($search, function (Builder $query, array $search) {
                if (isset($search['district_name'])) {
                    $query->whereRaw("districts.name LIKE CONCAT('%', ?, '%')", [$search['district_name']]);
                }

                if (isset($search['province_id'])) {
                    $query->whereRaw("provinces.id = ?", [$search['province_id']]);
                }
            })
            ->orderByRaw("$sort $order");
    }

    public function save(array $district): Model | Builder
    {
        return District::query()->create($district);
    }
}
