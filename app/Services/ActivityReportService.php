<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

interface ActivityReportService
{
    public function save(array $activityReport): Model | Builder;
}
