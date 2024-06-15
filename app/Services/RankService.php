<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

interface RankService
{
    public function findOne(int $id): Model | Builder | null;

    public function findByName(string $name): Model | Builder | null;

    public function exists(int $id): bool;

    public function existsByName(string $name): bool;

    public function delete(int $id): bool;

    public function update(array $rank): bool;

    public function search(array $filter): Collection;

    public function save(array $rank): Model | Builder;

}
