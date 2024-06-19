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
        return Education::query()->where('id', $id)->first();
    }

    public function findByName(string $name): Model | Builder
    {
        return Education::query()->where('name', $name)->first();
    }

    public function exists(int $id): bool
    {
        return Education::query()->where('id', $id)->exists();
    }

    public function existsByName(string $name): bool
    {
        return Education::query()->where('name', $name)->exists();
    }

    public function delete(int $id): bool
    {
        return Education::query()->where('id', $id)->delete();
    }

    public function update(array $education): bool
    {
        $id = $education[ 'id' ];
        unset($education[ 'id' ]);

        return Education::query()
            ->where('id', $id)
            ->update($education);
    }

    public function search(array $filter): Collection
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
