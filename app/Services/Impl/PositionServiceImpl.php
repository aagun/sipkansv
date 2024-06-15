<?php

namespace App\Services\Impl;

use App\Services\PositionService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Position;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Collection;

class PositionServiceImpl implements PositionService
{
    public function findOne(int $id): Model | Builder
    {
        return new Position();
    }

    public function findByName(string $name): Model | Builder
    {
        return new Position();
    }

    public function exist(int $id): bool
    {
        return false;
    }

    public function existByName(string $name): bool
    {
        return false;
    }

    public function delete(int $id): bool
    {
        return false;
    }

    public function update(array $position): bool
    {
        return Position::query()
            ->where('id', $position['id'])
            ->update($position);
    }

    public function search(array $filter): Collection
    {
        return Position::query()
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