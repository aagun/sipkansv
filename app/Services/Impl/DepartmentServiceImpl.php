<?php

namespace App\Services\Impl;

use App\Services\DepartmentService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Department;
use Illuminate\Pagination\LengthAwarePaginator;

class DepartmentServiceImpl implements DepartmentService
{
    public function findOne(int $id): Model | Builder | null
    {
        return Department::query()->where('id', $id)->first();
    }

    public function findByName(string $name): Model | Builder | null
    {
        return Department::query()->where('name', $name)->first();
    }

    public function exists(int $id): bool
    {
        return Department::query()->where('id', $id)->exists();
    }

    public function existsByName(string $name): bool
    {
        return Department::query()->where('name', $name)->exists();
    }

    public function delete(int $id): bool
    {
        return Department::query()->where('id', $id)->delete();
    }

    public function update(array $department): bool
    {
        $id = $department['id'];
        unset($department['id']);

        return Department::query()
                ->where('id', $id)
                ->update($department);
    }

    public function search(array $filter): LengthAwarePaginator
    {
        if ($filter['limit'] == 0) $filter['limit'] = $this->searchMainQuery($filter)->count();
        return $this->searchMainQuery($filter)
            ->paginate(perPage: $filter['limit'], page: $filter['offset']);
    }

    private function searchMainQuery(array $filter): Builder
    {
        $search = $filter['search'];
        $order = $filter['order'];
        $permissibleSort = ['name', 'description'];
        $sort = validateArraySort($filter, $permissibleSort, 'id');

        return Department::query()
            ->when($search, function (Builder $query, array $search) {
                if (isset($search['name'])) {
                    $query->whereRaw("name LIKE CONCAT('%', ?, '%')", [$search['name']]);
                }

                if (isset($search['description'])) {
                    $query->whereRaw("description LIKE CONCAT('%', ?, '%')", [$search['description']]);
                }
            })
            ->orderByRaw("$sort $order");
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
