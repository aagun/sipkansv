<?php

namespace App\Services\Impl;

use App\Services\InstitutionService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Institution;

class InstitutionServiceImpl implements InstitutionService
{
    public function findOne(int $id): Model | Builder | null
    {
        return Institution::query()->where('id', $id)->first();
    }

    public function findByName(string $name): Model | Builder | null
    {
        return Institution::query()->where('name', $name)->first();
    }

    public function exists(int $id): bool
    {
        return Institution::query()->where('id', $id)->exists();
    }

    public function existsByName(string $name): bool
    {
        return Institution::query()->where('name', $name)->exists();
    }

    public function delete(int $id): bool
    {
        return Institution::query()->where('id', $id)->delete();
    }

    public function update(array $institution): bool
    {
        $id = $institution[ 'id' ];
        unset($institution[ 'id' ]);

        return Institution::query()
            ->where('id', $id)
            ->update($institution);
    }

    public function search(array $filter): Collection
    {
        return Institution::query()
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

    public function save(array $institution): Model | Builder
    {
        return Institution::query()->create($institution);
    }

    public function saveAll(array $institutions): void
    {
        foreach ($institutions as $institution) {
            $this->save($institution);
        }
    }

}
