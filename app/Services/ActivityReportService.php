<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

interface ActivityReportService
{
    public function save(array $activityReport): Model | Builder;

    public function update(array $activityReport): bool;

    public function search(array $filter): LengthAwarePaginator;

    public function detail(int $id): Model | null | Builder;

    public function exists(int $id): bool;
}
