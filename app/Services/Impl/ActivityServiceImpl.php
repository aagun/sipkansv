<?php

namespace App\Services\Impl;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Services\ActivityService;
use App\Models\Activity;
use Illuminate\Pagination\LengthAwarePaginator;

class ActivityServiceImpl implements ActivityService
{
    public function findOne(int $id): Model | Builder | null
    {
        return Activity::query()->where('id', $id)->first();
    }

    public function findByName(string $name): Model | Builder | null
    {
        return Activity::query()->where('name', $name)->first();
    }

    public function exists(int $id): bool
    {
        return Activity::query()->where('id' , $id)->exists();
    }

    public function existsByName(string $name): bool
    {
        return Activity::query()->where('name' , $name)->exists();
    }

    public function delete(int $id): bool
    {
        return Activity::query()
            ->where('id', $id)
            ->delete();
    }

    public function update(array $activity): bool
    {
        $id = $activity[ 'id' ];
        unset($activity['id']);

        return Activity::query()
            ->where('id', $id)
            ->update($activity);
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

        return Activity::query()
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

    public function save(array $activity): Model | Builder
    {
        return Activity::query()->create($activity);
    }
}
