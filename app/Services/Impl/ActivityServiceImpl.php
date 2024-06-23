<?php

namespace App\Services\Impl;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Services\ActivityService;
use App\Models\Activity;

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

    public function search(array $filter): Collection
    {
        return Activity::query()
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

    public function save(array $activity): Model | Builder
    {
        return Activity::query()->create($activity);
    }
}
