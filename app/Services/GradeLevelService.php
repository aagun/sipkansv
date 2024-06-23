<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

interface GradeLevelService
{
    public function findOne(int $id): Model | Builder | null;

    public function findByName(string $name): Model | Builder | null;

    public function exists(int $id): bool;

    public function existsByName(string $name): bool;

    public function delete(string $id): bool;

    public function update(array $gradeLevel): bool;

    public function search(array $filter): LengthAwarePaginator;

    public function save(array $gradeLevel): Model | Builder;

    public function saveAll(array $gradeLevels);
}
