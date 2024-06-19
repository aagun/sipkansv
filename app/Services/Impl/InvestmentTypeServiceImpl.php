<?php

namespace App\Services\Impl;

use App\Services\InvestmentTypeService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Models\InvestmentType;

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

    public function search(array $filter): Collection
    {
        return InvestmentType::query()
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
