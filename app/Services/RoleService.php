<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

interface RoleService
{
    public function findAll(): Collection;

    public function findOne(int $id): Model | Builder;

    public function findOneByName(string $name): Model | Builder;

    public function save(array $role): Model | Builder;

    public function saveAll(array $roles);

    public function update(array $role): bool;

    public function delete(int $id): bool;
}
