<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

interface PositionService
{
    public function findOne(int $id): Model | Builder;

    public function findByName(string $name): Model | Builder;

    public function exist(int $id): bool;

    public function existByName(string $name): bool;

    public function delete(int $id): bool;

    public function update(array $position): bool;

    public function search(array $filter): Collection;

    public function save(array $position): Model | Builder;

    public function saveAll(array $positions);
}
