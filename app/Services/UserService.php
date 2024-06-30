<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Enums\UserRole;

interface UserService
{
    public function findOne(int $id): Builder | Model | null;

    public function findByName(string $name): Builder | Model | null;

    public function findByRoleNameAndPositionId(UserRole $roleName, mixed $positionId = null): LengthAwarePaginator;

    public function exists(int $id): bool;

    public function existsByStatus(int $id, string $status): bool;

    public function existsByName(string $name): bool;

    public function save(array $user): Builder | Model;

    public function saveAll(array $users): void;

    public function search(array $filter);

    public function delete(int $id);

    public function update(array $user);

    public function userDetail(int $id);
}
