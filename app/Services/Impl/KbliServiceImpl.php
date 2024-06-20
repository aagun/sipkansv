<?php

namespace App\Services\Impl;

use App\Services\KbliService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Kbli;
use Illuminate\Database\Eloquent\Collection;

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

    public function existsByName(string $name): bool
    {
        return Kbli::query()->where('name' , $name)->exists();
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

    public function search(array $filter): Collection
    {
        return Kbli::query()
            ->leftJoin('sub_sectors', 'sub_sectors.id', '=', 'kblis.sub_sector_id')
            ->when($filter, function (Builder $query, array $filter) {
                if (isset($filter['code'])) {
                    $query->whereRaw("kblis.code LIKE CONCAT('%', ?, '%')", [$filter['code']]);
                }

                if (isset($filter['name'])) {
                    $query->whereRaw("kblis.name LIKE CONCAT('%', ?, '%')", [$filter['name']]);
                }

                if (isset($filter['sub_sector'])) {
                    $query->whereRaw("sub_sectors.id = ? ", [$filter['sub_sector']]);
                }
            })
            ->orderByRaw("kblis.id asc")
            ->get();
    }

    public function save(array $kbli): Model | Builder
    {
        return Kbli::query()->create($kbli);
    }
}
