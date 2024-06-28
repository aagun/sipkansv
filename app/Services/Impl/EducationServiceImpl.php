<?php

namespace App\Services\Impl;

use App\Services\EducationService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Education;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\LengthAwarePaginator;

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

    public function search(array $filter): LengthAwarePaginator
    {
        if ($filter['limit'] == 0) $filter['limit'] = $this->searchMainQuery($filter)->count();
        return $this->searchMainQuery($filter)
            ->paginate(perPage: $filter['limit'], page: $filter['offset']);
    }

    private function searchMainQuery(array $filter)
    {
        $search = $filter['search'];
        $order = $filter['order'];
        $permissibleSort = ['name', 'description'];
        $sort = validateArraySort($filter, $permissibleSort, 'id');

        return Education::query()
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
