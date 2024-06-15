<?php

namespace App\Services\Impl;

use App\Services\RankService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Rank;

class RankServiceImpl implements RankService
{
    public function findOne(int $id): Model | Builder | null
    {
        return null;
    }

    public function findByName(string $name): Model | Builder | null
    {
        return null;
    }

    public function exists(int $id): bool
    {
        return false;
    }

    public function existsByName(string $name): bool
    {
        return false;
    }

    public function delete(int $id): bool
    {
        return false;
    }

    public function update(array $rank): bool
    {
        return false;
    }

    public function search(array $filter): Collection
    {
        return Rank::query()
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

    public function save(array $rank): Model | Builder
    {
        return Rank::query()->create($rank);
    }
}
