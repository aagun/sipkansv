<?php

namespace App\Services\Impl;

use App\Services\PositionService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Position;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\LengthAwarePaginator;

class PositionServiceImpl implements PositionService
{
    public function findOne(int $id): Model | Builder | null
    {
        return Position::query()->where('id', $id)->first();
    }

    public function findByName(string $name): Model | Builder | null
    {
        return Position::query()->where('name', $name)->first();
    }

    public function exists(int $id): bool
    {
        return Position::query()->where('id', $id)->exists();
    }

    public function existsByName(string $name): bool
    {
        return Position::query()->where('name', $name)->exists();
    }

    public function delete(int $id): bool
    {
        return Position::query()
            ->where('id', $id)
            ->delete();
    }

    public function update(array $position): bool
    {
        return Position::query()
            ->where('id', $position['id'])
            ->update($position);
    }

    public function search(array $filter): LengthAwarePaginator
    {
        if ($filter['limit'] == 0) $filter['limit'] = $this->searchMainQuery($filter)->count();
        return $this->searchMainQuery($filter)
            ->paginate(perPage: $filter['limit'], page: $filter['offset']);
    }

    private function searchMainQuery(array $filter): Builder
    {
        $search = $filter['search'];
        $order = $filter['order'];
        $permissibleSort = ['name', 'description'];
        $sort = validateArraySort($filter, $permissibleSort, 'id');

        return Position::query()
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

    public function save(array $position): Model | Builder
    {
        return Position::query()->create($position);
    }

    public function saveAll(array $positions): bool
    {
        try {
            foreach ($positions as $position) {
                $this->save($position);
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }

        return true;
    }

}
