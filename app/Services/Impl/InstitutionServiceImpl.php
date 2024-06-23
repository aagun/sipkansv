<?php

namespace App\Services\Impl;

use App\Services\InstitutionService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Institution;
use Illuminate\Pagination\LengthAwarePaginator;

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

    public function search(array $filter): LengthAwarePaginator
    {
        $search = $filter['search'];
        $order = $filter['order'];
        $permissibleSort = ['name', 'description'];
        $sort = validateArraySort($filter, $permissibleSort, 'id');

        return Institution::query()
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
