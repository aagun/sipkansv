<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\EducationService;
use Database\Seeders\DatabaseSeeder;

class EducationServiceTest extends TestCase
{
    private EducationService $educationService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->educationService = $this->app->make(EducationService::class);
    }

    public function testEducationUsers()
    {
        $this->seed(DatabaseSeeder::class);
        $education = $this->educationService->findByName('SMA');
        $users = $education->users;
        self::assertNotNull($users);
        self::assertEquals(1, $users->count());
    }


}
