<?php

namespace App\Services\Impl;

use App\Services\InvestmentTypeService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Models\InvestmentType;
use Illuminate\Pagination\LengthAwarePaginator;

class InvestmentTypeServiceImpl implements InvestmentTypeService
{
    public function findOne(int $id): Model | Builder | null
    {
        return InvestmentType::query()->where('id', $id)->first();
    }

    public function findByName(string $name): Model | Builder | null
    {
        return InvestmentType::query()->where('name', $name)->first();
    }

    public function exists(int $id): bool
    {
        return InvestmentType::query()->where('id', $id)->exists();
    }

    public function existsByName(string $name): bool
    {
        return InvestmentType::query()->where('name', $name)->exists();
    }

    public function delete(int $id): bool
    {
        return InvestmentType::query()->where('id', $id)->delete();
    }

    public function update(array $investmentType): bool
    {
        $id = $investmentType['id'];
        unset($investmentType['id']);

        return InvestmentType::query()
            ->where('id', $id)
            ->update($investmentType);
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

        return InvestmentType::query()
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

    public function save(array $investmentType): Model | Builder
    {
        return InvestmentType::query()->create($investmentType);
    }

    public function saveAll(array $investmentTypes): void
    {
        foreach ($investmentTypes as $investmentType) {
            $this->save($investmentType);
        }
    }

}
