<?php

namespace Tests\Feature;

use Tests\TestCase;
use Database\Seeders\DepartmentSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Support\Facades\DB;
use App\Services\DepartmentService;

class DepartmentServiceTest extends TestCase
{
    private DepartmentService $departmentService;

    protected function setUp(): void
    {
        parent::setUp();

        DB::delete('delete from departments');
        DB::delete('delete from users');

        $this->departmentService = $this->app->make(DepartmentService::class);
    }

    public function testDepartmentUsers()
    {
        $this->seed([DepartmentSeeder::class, UserSeeder::class]);
        $department = $this->departmentService->findByName('Bidang PSDKP');
        self::assertEquals(3, $department->users->count());
    }
}
