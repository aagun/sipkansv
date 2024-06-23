<?php

namespace App\Services\Impl;

use App\Services\ActivityReportService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Models\ActivityReport;

class ActivityReportServiceImpl implements ActivityReportService
{
    public function save(array $activityReport): Model | Builder
    {
        return ActivityReport::query()->create($activityReport);
    }

}
