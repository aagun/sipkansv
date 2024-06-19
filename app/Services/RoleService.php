<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

interface RoleService
{
    public function findAll(): Collection;

    public function findOne(int $id): Model | Builder | null;

    public function findOneByName(string $name): Model | Builder | null;

    public function save(array $role): Model | Builder;

    public function saveAll(array $roles);

    public function update(array $role): bool;

    public function delete(int $id): bool;

    public function searchRole(array $filter): Collection;

    public function exists(int $id): bool;
}
