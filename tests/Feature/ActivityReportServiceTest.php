<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\ActivityReportService;
use Carbon\Carbon;
use Database\Seeders\DatabaseSeeder;

class ActivityReportServiceTest extends TestCase
{
    private ActivityReportService $activityReportService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->activityReportService = $this->app->make(ActivityReportService::class);
    }

    public function testExportData()
    {
        $this->seed(DatabaseSeeder::class);
        $filter = [
            'start_inspection_date' => Carbon::now()->month(1)->firstOfMonth()->format('Y-m-d'),
            'end_inspection_date' => Carbon::now()->month(12)->lastOfMonth()->format('Y-m-d'),
        ];

        $collection = $this->activityReportService->export($filter);
        self::assertEquals(15, $collection->count());
    }


}
