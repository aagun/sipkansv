<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\DepartmentService;
use Database\Seeders\DatabaseSeeder;

class DepartmentServiceTest extends TestCase
{
    private DepartmentService $departmentService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->departmentService = $this->app->make(DepartmentService::class);
    }

    public function testDepartmentUsers()
    {
        $this->seed(DatabaseSeeder::class);
        $department = $this->departmentService->findByName('Bidang Pengawasan Sumber Daya Kelautan dan Perikanan');
        self::assertEquals(3, $department->users->count());
    }
}
