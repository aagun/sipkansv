<?php

namespace App\Services\Impl;

use App\Services\RoleService;
use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class RoleServiceImpl implements RoleService
{
    public function findAll(): Collection
    {
        return Role::all();
    }

    public function findOne(int $id): Model | Builder | null
    {
        return Role::query()->where('id', $id)->first();
    }

    public function findOneByName(string $name): Model | Builder | null
    {
        return Role::query()
            ->where('name', $name)
            ->first();
    }

    public function save(array $role): Model | Builder
    {
        return Role::query()->create($role);
    }

    public function saveAll(array $roles): void
    {
        foreach ($roles as $role) {
            $this->save($role);
        }
    }

    public function update(array $role): bool
    {
        return Role::query()
            ->where('id', $role['id'])
            ->update($role);
    }

    public function delete(int $id): bool
    {
        return Role::query()
            ->where('id', $id)
            ->delete();
    }

    public function searchRole(array $filter): Collection
    {
        return Role::query()
            ->when($filter, function (Builder $query, array $filter) {
                if (isset($filter['name'])) {
                    $query->whereRaw("name LIKE CONCAT('%', ?, '%')", [$filter['name']]);
                }

                if (isset($filter['description'])) {
                    $query->whereRaw("description LIKE CONCAT('%', ?, '%')", [$filter['description']]);
                }
            })
            ->orderByRaw("id asc")
            ->get();
    }

    public function exists(int $id): bool
    {
        return Role::query()->where('id', $id)->exists();
    }

}
