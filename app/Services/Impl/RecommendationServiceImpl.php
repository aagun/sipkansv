<?php

namespace App\Services\Impl;

use App\Services\RecommendationService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Recommendation;
use Illuminate\Pagination\LengthAwarePaginator;

class RecommendationServiceImpl implements RecommendationService
{
    public function findOne(int $id): Model | Builder | null
    {
        return Recommendation::query()->where('id', $id)->first();
    }

    public function findByName(string $name): Model | Builder | null
    {
        return Recommendation::query()->where('name', $name)->first();
    }

    public function exists(int $id): bool
    {
        return Recommendation::query()->where('id' , $id)->exists();
    }

    public function existsByName(string $name): bool
    {
        return Recommendation::query()->where('name' , $name)->exists();
    }

    public function delete(int $id): bool
    {
        return Recommendation::query()
            ->where('id', $id)
            ->delete();
    }

    public function update(array $recommendation): bool
    {
        $id = $recommendation[ 'id' ];
        unset($recommendation['id']);

        return Recommendation::query()
            ->where('id', $id)
            ->update($recommendation);
    }

    public function search(array $filter): LengthAwarePaginator
    {
        $search = $filter['search'];
        $order = $filter['order'];
        $permissibleSort = ['name', 'description'];
        $sort = validateArraySort($filter, $permissibleSort, 'id');

        return Recommendation::query()
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

    public function save(array $recommendation): Model | Builder
    {
        return Recommendation::query()->create($recommendation);
    }
}
