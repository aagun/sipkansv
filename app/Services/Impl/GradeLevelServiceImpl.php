<?php

namespace App\Services\Impl;

use App\Services\GradeLevelService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Models\GradeLevel;
use Illuminate\Pagination\LengthAwarePaginator;

class GradeLevelServiceImpl implements GradeLevelService
{
    public function findOne(int $id): Model | Builder | null
    {
        return GradeLevel::query()->where('id', $id)->first();
    }

    public function findByName(string $name): Model | Builder | null
    {
        return GradeLevel::query()->where('name', $name)->first();
    }

    public function exists(int $id): bool
    {
        return GradeLevel::query()->where('id', $id)->exists();
    }

    public function existsByName(string $name): bool
    {
        return GradeLevel::query()->where('name', $name)->exists();
    }

    public function delete(string $id): bool
    {
        return GradeLevel::query()->where('id', $id)->delete();
    }

    public function update(array $gradeLevel): bool
    {
        $id = $gradeLevel['id'];
        unset($gradeLevel['id']);
        return GradeLevel::query()->where('id', $id)->update($gradeLevel);
    }

    public function search(array $filter): LengthAwarePaginator
    {
        $search = $filter['search'];
        $order = $filter['order'];
        $permissibleSort = ['name', 'description'];
        $sort = validateArraySort($filter, $permissibleSort, 'id');

        return GradeLevel::query()
            ->when($search, function(Builder $query, $search) {
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

    public function save(array $gradeLevel): Model | Builder
    {
        return GradeLevel::query()->create($gradeLevel);
    }

    public function saveAll(array $gradeLevels): void
    {
        foreach ($gradeLevels as $gradeLevel) {
            $this->save($gradeLevel);
        }
    }

}
