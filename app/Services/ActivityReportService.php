<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface ActivityReportService
{
    public function save(array $activityReport): Model | Builder;

    public function update(array $activityReport): bool;

    public function search(array $filter): LengthAwarePaginator;

    public function detail(int $id): Model | null | Builder;

    public function exists(int $id): bool;

    public function export(array $filter): Collection;

    public function pivotTableByObservationNameAndUserDepartmentId(int $observationId, ?int $departmentId = null): Model | Builder | null;
}
