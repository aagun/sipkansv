<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface EducationService
{
    public function findOne(int $id): Model | Builder;

    public function findByName(string $name): Model | Builder;

    public function exists(int $id): bool;

    public function existsByName(string $name): bool;

    public function delete(int $id): bool;

    public function update(array $education): bool;

    public function search(array $filter): LengthAwarePaginator;

    public function save(array $education): Model | Builder;

    public function saveAll(array $educations);
}
