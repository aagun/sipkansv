<?php

namespace App\Services\Impl;

use App\Services\EducationService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Education;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Collection;

class EducationServiceImpl implements EducationService
{
    public function findOne(int $id): Model | Builder
    {
        return new Education();
    }

    public function findByName(string $name): Model | Builder
    {
        return new Education();
    }

    public function exist(int $id): bool
    {
        return false;
    }

    public function existByName(string $name): bool
    {
        return false;
    }

    public function delete(int $id): bool
    {
        return false;
    }

    public function update(array $education): bool
    {
        return Education::query()
            ->where('id', $education['id'])
            ->update($education);
    }

    public function searchEducation(array $filter): Collection
    {
        return Education::query()
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

    public function save(array $education): Model | Builder
    {
        return Education::query()->create($education);
    }

    public function saveAll(array $educations): bool
    {
        try {
            foreach ($educations as $education) {
                $this->save($education);
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }

        return true;
    }

}
