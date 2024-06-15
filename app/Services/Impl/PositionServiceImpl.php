<?php

namespace App\Services\Impl;

use App\Services\PositionService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Position;
use Illuminate\Support\Facades\Log;

class PositionServiceImpl implements PositionService
{
    public function findOne(int $id): Model | Builder
    {
        // TODO: Implement findOne() method.
    }

    public function findByName(string $name): Model | Builder
    {
        // TODO: Implement findByName() method.
    }

    public function exist(int $id): bool
    {
        // TODO: Implement exist() method.
    }

    public function existByName(string $name): bool
    {
        // TODO: Implement existByName() method.
    }

    public function delete(int $id): bool
    {
        // TODO: Implement delete() method.
    }

    public function update(array $position): bool
    {
        return Position::query()
            ->where('id', $position['id'])
            ->update($position);
    }

    public function search(array $position)
    {
        // TODO: Implement search() method.
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
