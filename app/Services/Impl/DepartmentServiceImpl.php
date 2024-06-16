<?php

namespace App\Services\Impl;

use App\Services\DepartmentService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Department;

class DepartmentServiceImpl implements DepartmentService
{
    public function findOne(int $id): Model | Builder | null
    {
        return null;
    }

    public function findByName(string $name): Model | Builder | null
    {
        return null;
    }

    public function exists(int $id): bool
    {
        return false;
    }

    public function existsByName(string $name): bool
    {
        return false;
    }

    public function delete(int $id): bool
    {
        return false;
    }

    public function update(array $department): bool
    {
        $id = $department['id'];
        unset($department['id']);

        return Department::query()
                ->where('id', $id)
                ->update($department);
    }

    public function search(array $filter): Collection
    {
        return Department::query()
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

    public function save(array $department): Model | Builder
    {
        return Department::query()->create($department);
    }

    public function saveAll(array $departments): void
    {
        foreach ($departments as $department) {
            $this->save($department);
        }
    }

}
