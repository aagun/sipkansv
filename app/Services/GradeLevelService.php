<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

interface GradeLevelService
{
    public function findByName(string $name): Model | Builder | null;

    public function exists(string $name): bool;

    public function delete(string $name): bool;

    public function update(array $gradeLevel): bool;

    public function search(array $filter): Collection;

    public function save(array $gradeLevel): Model | Builder;

    public function saveAll(array $gradeLevels);
}
