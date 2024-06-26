<?php

namespace App\Services\Impl;

use App\Services\KbliService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Kbli;
use Illuminate\Pagination\LengthAwarePaginator;

class KbliServiceImpl implements KbliService
{
    public function findOne(int $id): Model | Builder | null
    {
        return Kbli::query()->where('id', $id)->first();
    }

    public function findByName(string $name): Model | Builder | null
    {
        return Kbli::query()->where('name', $name)->first();
    }

    public function exists(int $id): bool
    {
        return Kbli::query()->where('id' , $id)->exists();
    }

    public function existsBySubSectorId(int $subSectorId): bool
    {
        return Kbli::query()->where('sub_sector_id' , $subSectorId)->exists();
    }

    public function existsByName(string $name): bool
    {
        return Kbli::query()->where('name' , $name)->exists();
    }

    public function existsByCode(int $code): bool
    {
        return Kbli::query()->where('code' , $code)->exists();
    }

    public function delete(int $id): bool
    {
        return Kbli::query()
            ->where('id', $id)
            ->delete();
    }

    public function update(array $kbli): bool
    {
        $id = $kbli[ 'id' ];
        unset($kbli['id']);

        return Kbli::query()
            ->where('id', $id)
            ->update($kbli);
    }

    public function search(array $filter): LengthAwarePaginator
    {
        $search = $filter['search'];
        $order = $filter['order'];
        $permissibleSort = [
            'code' => 'kblis.code',
            'name' => 'kblis.name',
            'sub_sector' => 'sub_sectors.name'
        ];
        $sort = validateObjectSort($filter, $permissibleSort, $permissibleSort['code']);
        return Kbli::query()
            ->select([
                'kblis.code AS code',
                'kblis.name AS name',
                'sub_sectors.name AS sub_sector'
            ])
            ->join('sub_sectors', 'kblis.sub_sector_id', '=', 'sub_sectors.id')
            ->when($search, function (Builder $query, array $search) {
                if (isset($search['code'])) {
                    $query->whereRaw("kblis.code LIKE CONCAT('%', ?, '%')", [$search['code']]);
                }

                if (isset($search['name'])) {
                    $query->whereRaw("kblis.name LIKE CONCAT('%', ?, '%')", [$search['name']]);
                }

                if (isset($search['sub_sector'])) {
                    $query->whereRaw("sub_sectors.id = ? ", [$search['sub_sector']]);
                }
            })
            ->orderByRaw("$sort $order")
            ->paginate(perPage: $filter['limit'], page: $filter['offset']);
    }

    public function save(array $kbli): Model | Builder
    {
        return Kbli::query()->create($kbli);
    }
}
