<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

interface InstitutionService
{
    public function findOne(int $id): Model | Builder | null;

    public function findByName(string $name): Model | Builder | null;

    public function exists(int $id): bool;

    public function existsByName(string $name): bool;

    public function delete(int $id): bool;

    public function update(array $institution): bool;

    public function search(array $filter): LengthAwarePaginator;

    public function save(array $institution): Model | Builder;

    public function saveAll(array $institutions);
}
