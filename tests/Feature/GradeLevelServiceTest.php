<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\GradeLevelService;
use Database\Seeders\DatabaseSeeder;

class GradeLevelServiceTest extends TestCase
{
    private GradeLevelService $gradeLevelService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->gradeLevelService = $this->app->make(GradeLevelService::class);
    }

    public function testGradeLevelUsers()
    {
        $this->seed(DatabaseSeeder::class);

        $grade_level = $this->gradeLevelService->findByName('II/C');
        $grade_level->load('users');
        self::assertEquals(4, $grade_level->users->count());
    }


}
