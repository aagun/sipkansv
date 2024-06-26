<?php

namespace App\Services\Impl;

use App\Services\RoleService;
use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

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

    public function search(array $filter): LengthAwarePaginator
    {

        $search = $filter['search'];
        $order = $filter['order'];
        $permissibleSort = ['name', 'description'];
        $sort = validateArraySort($filter, $permissibleSort, 'id');

        return Role::query()
            ->when($search, function (Builder $query, array $search) {
                if (isset($search['name'])) {
                    $query->whereRaw("name LIKE CONCAT('%', ?, '%')", [$search['name']]);
                }

                if (isset($search['description'])) {
                    $query->whereRaw("description LIKE CONCAT('%', ?, '%')", [$search['description']]);
                }
            })
            ->orderByRaw("$sort $order")
            ->paginate(perPage: $filter['limit'], page: $filter['offset']);
    }

    public function exists(int $id): bool
    {
        return Role::query()->where('id', $id)->exists();
    }

    public function existsByName(string $name): bool
    {
        return Role::query()->where('name', $name)->exists();
    }
}
