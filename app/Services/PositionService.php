<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\PositionSearchRequest;

interface PositionService
{
    public function findOne(int $id): Model | Builder;

    public function findByName(string $name): Model | Builder;

    public function exist(int $id): bool;

    public function existByName(string $name): bool;

    public function delete(int $id): bool;

    public function update(array $position): bool;

    public function search(array $position);

    public function save(array $position): Model | Builder;

    public function saveAll(array $positions);
}
