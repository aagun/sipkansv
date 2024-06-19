<?php

namespace App\Services\Impl;

use App\Services\GradeLevelService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Models\GradeLevel;

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
        return GradeLevel::query()->where('name', $id)->delete();
    }

    public function update(array $gradeLevel): bool
    {
        $id = $gradeLevel['id'];
        unset($gradeLevel['id']);
        return GradeLevel::query()->where('id', $id)->update($gradeLevel);
    }

    public function search(array $filter): Collection
    {
        return GradeLevel::query()
            ->when($filter, function(Builder $query, $filter) {
               if (isset($filter['name'])) {
                   $query->whereRaw("name LIKE CONCAT('%', ?, '%')", [$filter['name']]);
               }

               if (isset($filter['description'])) {
                   $query->whereRaw("description LIKE CONCAT('%', ?, '%')", [$filter['description']]);
               }
            })
            ->orderByRaw('name asc')
            ->get();
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
