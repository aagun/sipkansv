<?php

namespace App\Services\Impl;

use App\Services\RankService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Rank;
use Illuminate\Pagination\LengthAwarePaginator;

class RankServiceImpl implements RankService
{
    public function findOne(int $id): Model | Builder | null
    {
        return Rank::query()->where('id', $id)->first();
    }

    public function findByName(string $name): Model | Builder | null
    {
        return Rank::query()->where('name', $name)->first();
    }

    public function exists(int $id): bool
    {
        return Rank::query()->where('id' , $id)->exists();
    }

    public function existsByName(string $name): bool
    {
        return Rank::query()->where('name' , $name)->exists();
    }

    public function delete(int $id): bool
    {
        return Rank::query()
            ->where('id', $id)
            ->delete();
    }

    public function update(array $rank): bool
    {
        return Rank::query()
            ->where('id', $rank['id'])
            ->update($rank);
    }

    public function search(array $filter): LengthAwarePaginator
    {
        $search = $filter['search'];
        $order = $filter['order'];
        $permissibleSort = ['name', 'description'];
        $sort = validateArraySort($filter, $permissibleSort, 'id');

        return Rank::query()
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

    public function save(array $rank): Model | Builder
    {
        return Rank::query()->create($rank);
    }
}
